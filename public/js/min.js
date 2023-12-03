let array = [];
const element = document.getElementById("stars");
const ctx = element.getContext("2d");
let i = 0;
let moonX;
let moonY;

const drawMoon = () => {
    // Draw moon
    const moonRadius = 50;
    ctx.beginPath();
    ctx.arc(moonX, moonY, moonRadius, 0, Math.PI * 2, false);
    ctx.fillStyle = "white";
    ctx.fill();
    ctx.closePath();

    // Draw crescent moon
    ctx.globalCompositeOperation = 'destination-out'; // Set blend mode

    ctx.beginPath();
    ctx.arc(moonX - moonRadius / 2, moonY, moonRadius, 0, Math.PI * 2, false);
    ctx.fill();
    ctx.closePath();

    // Reset blend mode
    ctx.globalCompositeOperation = 'source-over';
}

setInterval(() => {
    i++;
    let x = Math.floor(Math.random() * window.innerWidth + 1);
    let y = Math.floor(Math.random() * window.innerHeight + 1);
    array.push([x, y]);
    ctx.beginPath();
    ctx.arc(x, y, 2, 0, 2 * Math.PI, false);
    ctx.fillStyle = "white";
    ctx.fill();
    ctx.closePath();
    if (i > 100) {
        clearArch();
    }
}, 100);


function clearArch() {
    if (array.length > 0) {
        const [x, y] = array.shift();
        ctx.clearRect(x - 3, y - 3, 8, 8); // Adjust the clear area based on your arc size
    }
}

function resizeCanvas() {
    element.width = window.innerWidth;
    element.height = window.innerHeight;
    moonX = element.width / 1.1;
    moonY = element.height / 6;
    drawMoon();
}

window.addEventListener("resize", resizeCanvas, false);
resizeCanvas();
drawMoon();


