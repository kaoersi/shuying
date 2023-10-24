//PC端 使右键和复制失效
document.oncontextmenu = new Function("event.returnValue=false");
document.onselectstart = new Function("event.returnValue=false");

//ios
document.oncontextmenu = function (e) {
    e.preventDefault();
};
document.onselectstart = function (e) {
    e.preventDefault();
};
//安卓
document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});
document.ontouchend = function () {
    throw new Error("NO ERRPR:禁止长按弹出");
}

