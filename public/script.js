let canvas = document.getElementById("canvas");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var io = io.connect('https://localhost:8080/')

let ctx = canvas.getContext('2d');

let x;
let y;
let mouseDown = false;

window.onmousedown = (e) => {
  ctx.moveTo(x , y);
  mouseDown = true;
};

window.onmouseup = (e) => {
  mouseDown = false;
};

io.on('ondraw' , ({x , y}) => {
  ctx.lineTo(x , y);
  ctx.stroke();
})

window.onmousemove = (e) => {
  x = e.clientX;
  y = e.clientY;
   if (mouseDown){
    io.emit("draw", { x, y})
    ctx.lineTo(x , y);
    ctx.stroke();
   }
};
