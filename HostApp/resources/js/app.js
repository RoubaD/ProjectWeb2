import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('waves');

    if (!canvas) {
        console.error('Canvas element with ID "waves" not found.');
        return;
    }

    const ctx = canvas.getContext('2d');

    let waves = [];
    const colors = [
        'rgba(145, 118, 110, 0.2)', // Subtle light color
        'rgba(183, 167, 169, 0.3)', // Gradient-like mid tone
        'rgba(252, 236, 227, 0.5)'  // Soft highlight
    ];

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    class Wave {
        constructor(color, speed, amplitude, wavelength, offset) {
            this.color = color;
            this.speed = speed;
            this.amplitude = amplitude;
            this.wavelength = wavelength;
            this.offset = offset;
            this.angle = 0;
        }

        draw() {
            ctx.beginPath();
            ctx.moveTo(0, canvas.height / 1.8); // Adjust height for subtlety

            for (let x = 0; x < canvas.width; x++) {
                const y =
                    Math.sin((x / this.wavelength + this.angle) * Math.PI * 2) *
                        this.amplitude +
                    canvas.height / 1.8;
                ctx.lineTo(x, y + this.offset);
            }

            ctx.lineTo(canvas.width, canvas.height);
            ctx.lineTo(0, canvas.height);
            ctx.closePath();
            ctx.fillStyle = this.color;
            ctx.fill();
        }

        update() {
            this.angle += this.speed;
            this.draw();
        }
    }

    function initWaves() {
        waves = [
            new Wave(colors[0], 0.005, 20, 300, -20), // Slower and smaller
            new Wave(colors[1], 0.003, 15, 400, 10),
            new Wave(colors[2], 0.002, 10, 500, 30)
        ];
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        waves.forEach((wave) => wave.update());
        requestAnimationFrame(animate);
    }

    initWaves();
    animate();
});
