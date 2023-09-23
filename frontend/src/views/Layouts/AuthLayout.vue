<script setup lang="ts">
    import { RouterView } from "vue-router";
    import { onMounted } from "vue";
    import { createNoise3D } from 'simplex-noise';
    // import * as dat from 'dat.gui';
    onMounted(() => {
        /**
         * requestAnimationFrame
         */
        window.requestAnimationFrame = (function(){
            return  window.requestAnimationFrame       ||
                    // window.webkitRequestAnimationFrame ||
                    // window.mozRequestAnimationFrame    ||
                    // window.oRequestAnimationFrame      ||
                    // window.msRequestAnimationFrame     ||
                    function (callback) {
                        window.setTimeout(callback, 1000 / 60);
                    };
        })();


        // Configs

        type ConfigType = {
            backgroundColor: string,
            particleNum: number;
            step: number;
            base: number;
            zInc: number;
        }

        var Configs: ConfigType = {
            backgroundColor: '#ffff',
            particleNum: 200,
            step: 5,
            base: 1000,
            zInc: 0.001
        };


        // Vars
        var canvas: HTMLCanvasElement,
            resetCanvasButton: HTMLButtonElement,
            context: CanvasRenderingContext2D,
            screenWidth: number,
            screenHeight: number,
            centerX: number,
            centerY : number,
            particles: Particle[] = [],
            hueBase = 0,
            simplexNoise: any,
            zoff = 0,
            gui;


        // Initialize
        function init() {
            canvas = document.getElementById('cnvs') as HTMLCanvasElement;

            resetCanvasButton = document.getElementById('reset-canvas') as HTMLButtonElement;

            window.addEventListener('resize', onWindowResize, false);
            onWindowResize();

            clearCnvs();

            for (var i = 0, len = Configs.particleNum; i < len; i++) {
                initParticle((particles[i] = new Particle()));
            }

            simplexNoise = createNoise3D();

            resetCanvasButton.addEventListener('click', clearCnvs, false);

            update();
        }


        // Event listeners

        function onWindowResize() {
            screenWidth  = canvas.width  = window.innerWidth;
            screenHeight = canvas.height = window.innerHeight;

            centerX = screenWidth / 2;
            centerY = screenHeight / 2;

            context= canvas.getContext('2d') as CanvasRenderingContext2D;
            context.lineWidth = 0.3;
            context.lineCap = context.lineJoin = 'round';
        }

        function clearCnvs() {
            context.save();
            context.globalAlpha = 1;
            context.fillStyle = Configs.backgroundColor;
            context.fillRect(0, 0, screenWidth, screenHeight);
            context.restore();
            
            simplexNoise = createNoise3D();
        }


        // Functions

        function getNoise(x: number, y: number, z: number) {
            var octaves = 4,
                fallout = 0.5,
                amp = 1, f = 1, sum = 0,
                i;

            for (i = 0; i < octaves; ++i) {
                amp *= fallout;
                sum += amp * (simplexNoise(x * f, y * f, z * f) + 1) * 0.5;
                f *= 2;
            }

            return sum;
        }

        function initParticle(p: Particle) {
            p.x = p.pastX = screenWidth * Math.random();
            p.y = p.pastY = screenHeight * Math.random();
            p.color.h = hueBase + Math.atan2(centerY - p.y, centerX - p.x) * 180 / Math.PI;
            p.color.s = 1;
            p.color.l = 0.5;
            p.color.a = 0;
        }


        // Update

        function update() {
            var step = Configs.step,
                base = Configs.base,
                i, p, angle, len;
            
            for (i = 0, len = particles.length; i < len; i++) {
                p = particles[i];

                p.pastX = p.x;
                p.pastY = p.y;
            
                angle = Math.PI * 6 * getNoise(p.x / base * 1.75, p.y / base * 1.75, zoff);
                p.x += Math.cos(angle) * step;
                p.y += Math.sin(angle) * step;
                
                if (p.color.a < 1) p.color.a += 0.003;

                context.beginPath();
                context.strokeStyle = p.color.toString();
                context.moveTo(p.pastX, p.pastY);
                context.lineTo(p.x, p.y);
                context.stroke();
                
                if (p.x < 0 || p.x > screenWidth || p.y < 0 || p.y > screenHeight) {
                    initParticle(p);
                }
            }
            
            hueBase += 0.1;
            zoff += Configs.zInc;

            requestAnimationFrame(update);
        }


        /**
         * HSLA
         */
        class HSLA {
            h: number;
            s: number;
            l: number;
            a: number;
            constructor(h?: number, s?: number, l?: number, a?: number) {
                this.h = h || 0;
                this.s = s || 0;
                this.l = l || 0;
                this.a = a || 0;
            }
        }

        HSLA.prototype.toString = function() {
            return 'hsla(' + this.h + ',' + (this.s * 100) + '%,' + (this.l * 100) + '%,' + this.a + ')';
        }

        /**
         * Particle
         */
        class Particle {
            x: number;
            y: number;
            color: HSLA;
            pastX: number;
            pastY: number;
            constructor(x?: number, y?: number, color?: HSLA) {
                this.x = x || 0;
                this.y = y || 0;
                this.color = color || new HSLA();
                this.pastX = this.x;
                this.pastY = this.y;
            }
        }


        // Run

        init();
    })
</script>

<template>
    <main>
        <button id="reset-canvas" class="btn btn-outline custom-button">CLEAR</button>
        <div class="responsive-auth">
            <div class="auth-container">
                <RouterView />
            </div>
        </div>
        <canvas id='cnvs'></canvas>
    </main>
</template>

<style scoped>
main {
    height: 100%;
    display: flex;
    justify-content: center;
}
.responsive-auth {
    width: 90vw;
    max-width: 25rem;
    min-width: 5rem;
}

canvas {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}
.auth-container {
    margin-top: 13vh;
    background-color: #ffffffce;
    border: 1px var(--button-color) solid;
    border-radius: 11px;
    padding: 2rem 3rem;
}
.custom-button {
    position: absolute;
    background-color: #ffffffce;
    min-width: auto;
    top: 0;
    right: 0;
    margin: 1rem;
}
</style>
 