<link rel="stylesheet" href="../../css/docs-style.css">
<?php

class ResourceDoc
{
    static function getErrorInfo($errors)
    {
        $json = file_get_contents(__DIR__ . '/resources/errors.json');
        $errorDocs = json_decode($json, true);
        $info = array();
        foreach ($errorDocs as $errorDoc) {
            foreach ($errors as $error) {
                if ($errorDoc["type"] === $error["type"]) {
                    $error["message"] = $errorDoc["message"];
                    array_push($info, $error);
                    break;
                }
            }
        }
        if (empty($info)) {
            return null;
        } else {
            // Sort by HTTP-code, from lowest to highest
            asort($info);
            return $info;
        }
    }

    static function getActionTitles($resource) {
        $titles = array();
        $json = file_get_contents(__DIR__ . "/resources/$resource.json");
        $actions = json_decode($json, true);

        foreach ($actions as $action) {
          array_push($titles, $action["title"]);
        }
        return $titles;
    }

    static function replaceSpaces($subject) {
        return str_replace(" ", "-", $subject);
    }

    static function printDocumentation($resource) {
        $json = file_get_contents(__DIR__ . "/resources/$resource.json");
        $states = json_decode($json, true);

        foreach ($states as $state) {
            echo '<section class="defaultSection main" id="' . self::replaceSpaces
                ($state["title"]) . '">';
            echo '<h1>' . $state["title"] . '</h1><br>';
            echo '<h2>Request</h2><br>';
            echo self::buildTableFromArray(array($state["request"]), array("HTTP-method", "URL"));

            if (isset($state["requiredInput"])) {
                echo "<br><h2>Required input</h2>";
                if ($state["request"]["httpMethod"] === "POST") {
                    echo "<p>All of the following keys are required.</p>";
                } else {
                    echo "<p>At least one of the following keys is required.</p>";
                }
                echo self::buildTableFromArray($state["requiredInput"], array("Key", "Type", "Can be null",
                    "Constraints"));
            }

            if (isset($state["requiredTokens"])) {
                echo "<br><h2>Required tokens</h2><br>";
                echo self::buildTableFromArray($state["requiredTokens"], array("Token", "Transfer details"));
            }


            echo '<br><h2>Returns on success</h2>';
            echo '<p>Code: ' . $state["successCode"] . '</p>';
            if (isset($state["returnFormat"])) {
                echo '<p>Format: ' . $state["returnFormat"] . '</p>';
            }
            if (isset($state["returnsOnSuccess"])) {
                echo self::buildTableFromArray($state["returnsOnSuccess"], array("Key", "Type", "Can be null"));
            }

            $errorInfo = self::getErrorInfo($state["errors"]);

            if ($errorInfo !== null) {
                echo "<br><h2>Errors</h2><br>";
                echo self::buildTableFromArray($errorInfo, array('Code', 'Type', 'Message'));
            }

            echo '</section>';
        }
    }

    static function buildTableFromArray($array, $header=null)
    {
        $html = '<table class="docs">';

        if ($header === null) {
            // Generate header from the array
            $html .= '<tr>';
            foreach ($array[0] as $key => $value) {
                $html .= '<th class="docs">' . htmlspecialchars($key) . '</th>';
            }
            $html .= '</tr>';
        } else if ($header !== false) {
            // Generate header from the header argument
            $html .= '<tr>';
            foreach ($header as $title) {
                $html .= '<th class="docs">' . htmlspecialchars($title) . '</th>';
            }
            $html .= '</tr>';
        }

        foreach ($array as $key => $value) {
            $html .= '<tr>';
            foreach ($value as $key2 => $value2) {
                $html .= '<td class="docs">' . htmlspecialchars($value2) . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html;
    }
}