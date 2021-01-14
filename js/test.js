document.writeln("hello");

let headerButtons = [
    document.getElementById("openLoginModalBtn"),
    document.getElementById("aboutBtn"),
    document.getElementById("appBtn"),
    document.getElementById("contactBtn")]

headerButtons.forEach(isOverflown);

function isOverflown(element) {
    let overflows = element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
    if (overflows) {
        document.writeln(element.id + " overflows!");
    }
    return overflows;
}