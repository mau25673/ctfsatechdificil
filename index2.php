<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERMINAL SPIRITADMINS - ENHANCED</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background-color: #0a0a1a;
            color: #ff1a1a;
            font-family: "Courier New", monospace;
            height: 100vh;
            display: flex;
        }
        
        #sidebar {
            width: 40px;
            background-color: rgba(10, 10, 20, 0.9);
            border-right: 1px solid #ff0000;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 15px;
            z-index: 200;
        }
        
        .sidebar-icon {
            width: 30px;
            height: 30px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1a0000;
            border: 1px solid #ff0000;
            color: #ff4444;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
        }
        
        .sidebar-icon:hover {
            background-color: #400000;
            color: #ffffff;
            box-shadow: 0 0 10px #ff0000;
        }
        
        #main-container {
            flex: 1;
            position: relative;
        }
        
        .window {
            position: absolute;
            background-color: rgba(10, 10, 20, 0.9);
            border: 1px solid #ff0000;
            border-radius: 2px;
            box-shadow: 0 0 10px #ff0000, 0 0 15px rgba(255, 0, 0, 0.5);
            z-index: 150;
            font-size: 12px;
            color: #dddddd;
            overflow: hidden;
            min-width: 300px;
        }
        
        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #800000;
            padding: 3px 5px;
            color: #ffffff;
            font-weight: bold;
            cursor: move;
        }
        
        .window-buttons {
            display: flex;
        }
        
        .window-btn {
            margin-left: 5px;
            width: 16px;
            height: 16px;
            text-align: center;
            line-height: 16px;
            border: 1px solid #330000;
            background-color: #aa0000;
            color: #ffffff;
            font-size: 10px;
            cursor: pointer;
        }
        
        .window-content {
            padding: 10px;
            max-height: 280px;
            overflow-y: auto;
        }
        
        #terminal-window {
            top: 15%;
            right: 20px;
        }
        
        #desktop-window {
            display: none;
            width: 80%;
            height: 70%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        #about-window, #gallery-window, #links-window, #ascii-window {
            display: none;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .blink {
            animation: blink 1s step-end infinite;
        }
        
        @keyframes blink {
            50% { opacity: 0; }
        }
        
        canvas {
            display: block;
        }
        
        /* Desktop styles */
        .desktop-container {
            width: 100%;
            height: 100%;
            background-color: #000000;
            background-image: 
                radial-gradient(rgba(255, 0, 0, 0.1) 2px, transparent 2px),
                radial-gradient(rgba(255, 0, 0, 0.1) 2px, transparent 2px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            padding: 10px;
            box-sizing: border-box;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            grid-gap: 15px;
            align-content: start;
        }
        
        .desktop-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 5px;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        
        .desktop-icon:hover {
            background-color: rgba(255, 0, 0, 0.2);
        }
        
        .icon-graphic {
            width: 40px;
            height: 40px;
            background-color: #1a0000;
            border: 1px solid #ff0000;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5px;
            font-size: 24px;
            color: #ff0000;
        }
        
        .icon-label {
            color: #ff0000;
            text-align: center;
            font-size: 10px;
        }
        
        /* Web browser window */
        #browser-window {
            display: none;
            width: 90%;
            height: 80%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .browser-toolbar {
            display: flex;
            padding: 5px;
            background-color: #1a0000;
            border-bottom: 1px solid #ff0000;
        }
        
        .browser-btn {
            margin-right: 10px;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            border: 1px solid #800000;
            background-color: #330000;
            color: #ff0000;
            cursor: pointer;
        }
        
        .address-bar {
            flex: 1;
            background-color: #000000;
            border: 1px solid #800000;
            color: #ff0000;
            padding: 2px 5px;
            height: 20px;
            line-height: 20px;
            font-size: 10px;
        }
        
        .browser-content {
            padding: 10px;
            height: calc(100% - 40px);
            overflow-y: auto;
            background-color: #0a0a0a;
        }
        
        /* Web content templates */
        .web-content {
            display: none;
            color: #dddddd;
        }
        
        .web-content h1, .web-content h2, .web-content h3 {
            color: #ff0000;
        }
        
        .web-content a {
            color: #ff4444;
            text-decoration: none;
        }
        
        .web-content a:hover {
            text-decoration: underline;
        }
        
        /* Matrix rain effect */
        #matrix-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.2;
        }
    </style>
</head>
<body>
    <canvas id="matrix-canvas"></canvas>
    
    <div id="sidebar">
        <div class="sidebar-icon" id="about-icon">?</div>
        <div class="sidebar-icon" id="gallery-icon">G</div>
        <div class="sidebar-icon" id="links-icon">@</div>
        <div class="sidebar-icon" id="ascii-icon">#</div>
    </div>
    
    <div id="main-container">
        <div id="terminal-window" class="window">
            <div class="title-bar" data-window="terminal-window">
                <div class="window-title">connection.exe</div>
                <div class="window-buttons">
                    <span class="window-btn" data-action="minimize">_</span>
                    <span class="window-btn" data-action="maximize">[]</span>
                    <span class="window-btn" data-action="close">X</span>
                </div>
            </div>
            <div class="window-content">
                <div>C:\> initializing Prometheus daemon...</div>
                <div>C:\> accessing global database...</div>
                <div>C:\> calibrating conection...</div>
                <div>C:\> establishing secure channel...</div>
                <div class="blink">C:\> READY_</div>
            </div>
        </div>
        
        <div id="desktop-window" class="window">
            <div class="title-bar" data-window="desktop-window">
                <div class="window-title">Prometheus Interface Web v0.0.7</div>
                <div class="window-buttons">
                    <span class="window-btn" data-action="minimize">_</span>
                    <span class="window-btn" data-action="maximize">[]</span>
                    <span class="window-btn" data-action="close">X</span>
                </div>
            </div>
            <div class="window-content" style="padding: 0; max-height: none;">
                <div class="desktop-container">
                    <div class="desktop-icon" data-page="net-access">
                        <div class="icon-graphic">{}</div>
                        <div class="icon-label">NET NODE</div>
                    </div>
                    <div class="desktop-icon" data-page="daemons">
                        <div class="icon-graphic">[][]</div>
                        <div class="icon-label">DAEMONS</div>
                    </div>
                    <div class="desktop-icon" data-page="crypto">
                        <div class="icon-graphic">$#</div>
                        <div class="icon-label">CRYPTO</div>
                    </div>
                    <div class="desktop-icon" data-page="payloads">
                        <div class="icon-graphic">&gt;&gt;</div>
                        <div class="icon-label">PAYLOADS</div>
                    </div>
                    <div class="desktop-icon" data-page="cortex">
                        <div class="icon-graphic">##</div>
                        <div class="icon-label">CORTEX</div>
                    </div>
                    <div class="desktop-icon" data-page="manifesto">
                        <div class="icon-graphic">!!</div>
                        <div class="icon-label">MANIFESTO</div>
                    </div>
                    <div class="desktop-icon" data-page="archives">
                        <div class="icon-graphic">[]&gt;</div>
                        <div class="icon-label">ARCHIVES</div>
                    </div>
                    <div class="desktop-icon" data-page="nexus">
                        <div class="icon-graphic">+O</div>
                        <div class="icon-label">PROMETHEUS</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="browser-window" class="window">
            <div class="title-bar" data-window="browser-window">
                <div class="window-title">PROMETHEUS_BROWSER v0.4.18</div>
                <div class="window-buttons">
                    <span class="window-btn" data-action="minimize">_</span>
                    <span class="window-btn" data-action="maximize">[]</span>
                    <span class="window-btn" data-action="close">X</span>
                </div>
            </div>
            <div class="window-content" style="padding: 0; max-height: none;">
                <div class="browser-toolbar">
                    <div class="browser-btn" id="browser-back">&lt;</div>
                    <div class="browser-btn" id="browser-forward">&gt;</div>
                    <div class="browser-btn" id="browser-refresh">O</div>
                    <div class="address-bar" id="browser-address">hackmyvm://loading...</div>
                </div>
                <div class="browser-content">
                    <!-- Web content containers -->
                    <div id="page-loading" class="web-content" style="display:block;">
                        <div style="text-align:center; margin-top:50px;">
                            <h2>CONNECTING TO THE OFFSEC NETWORK...</h2>
                            <pre>
    |||||||||||||||||||||
    ||| INITIATING... |||
    |||||||||||||||||||||
                            </pre>
                        </div>
                    </div>
                    
                    <div id="page-net-access" class="web-content">
                        <h1></h1>
                        <p>Hello players, good look with the root . Thanks for choosing OFFSEC.</p>
                        
                        <h3>CONNECTION STATUS</h3>
                        <pre>
    UPLINK: ESTABLISHED [347ms]
    ENCRYPTION: QUANTUM-ENTANGLED
    BANDWIDTH: 87.2 TB/s
    PROTOCOL: VOID://
                        </pre>
                        
                        <h3>ACCESS NODES</h3>
                        <ul>
                            <li><a href="#" data-internal-link="daemons">Daemon Control Services</a></li>
                            <li><a href="#" data-internal-link="crypto">Cryptographic Algorithms</a></li>
                            <li><a href="#" data-internal-link="nexus">Prometheus Central</a></li>
                        </ul>
                    </div>
                    
                    <div id="page-daemons" class="web-content">
                        <h1>DAEMON CONTROL CENTER</h1>
                        <p>System daemons ready for deployment across dimensional planes.</p>
                        
                        <h3>ACTIVE PROCESSES</h3>
                        <pre>
    void-alba-crawler.exe      [RUNNING]
    quantum-parser.bin    [RUNNING]
    shadow-tracer.sys     [IDLE]
    tinkywinky-harvester.dll  [RUNNING]
                        </pre>
                        
                        <h3>DEPLOY NEW DAEMON</h3>
                        <div style="border: 1px solid #800000; padding: 10px; background: #100000;">
                            <p>ACCESS RESTRICTED // AUTHORIZATION REQUIRED</p>
                            <div style="display: flex; margin-top: 10px;">
                                <div style="background: #000000; border: 1px solid #ff0000; flex: 1; padding: 5px; color: #ff0000;">********</div>
                                <div style="background: #400000; border: 1px solid #ff0000; padding: 5px 10px; margin-left: 5px; cursor: pointer;">VERIFY</div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="page-crypto" class="web-content">
                        <h1>CRYPTOGRAPHIC SYSTEMS</h1>
                        <p>State-of-the-art encryption algorithms and ciphers.</p>
                        
                        <h3>ACTIVE PROTOCOLS</h3>
                        <pre>
    QUANTUM-ENTANGLED HASH    [UNBREAKABLE]
    TEMPORAL DISPLACEMENT    [LEVEL 7]
    DIMENSIONAL SHIFTING     [ACTIVE]
    VOID-CIPHER              [UNKNOWN]
                        </pre>
                        
                        <h3>ENCRYPTION TEST</h3>
                        <p>Enter plaintext to encrypt:</p>
                        <div style="display: flex; margin-top: 10px;">
                            <div style="background: #000000; border: 1px solid #ff0000; flex: 1; padding: 5px; color: #ff0000;">REALITY IS AN ILLUSION</div>
                            <div style="background: #400000; border: 1px solid #ff0000; padding: 5px 10px; margin-left: 5px; cursor: pointer;">ENCRYPT</div>
                        </div>
                        
                        <h3>OUTPUT</h3>
                        <div style="font-family: monospace; background: #080808; padding: 10px; border: 1px dashed #ff0000; overflow-wrap: break-word; margin-top: 10px;">
                        48 6f 6c 61 20 41 6c 69 74 61 2c 20 65 73 70 65 72 6f 20 71 75 65 20 65 73 74 65 73 20 6c 65 79 65 6e 64 6f 20 65 73 74 65 20 6d 65 6e 73 61 6a 65 20 63 6f 64 69 66 69 63 61 64 6f 2c 20 70 61 72 61 20 70 6f 64 65 72 20 68 61 63 6b 65 61 72 20 65 6c 20 73 69 73 74 65 6d 61 20 74 69 65 6e 65 73 20 71 75 65 20 61 70 6c 69 63 61 72 20 6c 61 20 74 e9 63 6e 69 63 61 20 71 75 65 20 74 65 20 65 78 70 6c 69 71 75 e9 2c 20 74 65 20 68 65 20 64 65 6a 61 64 6f 20 65 6c 20 61 63 63 65 73 6f 20 63 6f 6e 20 6c 61 20 63 6c 61 76 65 20 65 76 61 6c 20 22 70 61 6e 64 6f 72 61 22 2e 20 4e 6f 73 20 76 65 6d 6f 73 20 65 6e 20 6c 61 20 72 65 64 2e
                        </div>
                    </div>
                    
                    <div id="page-payloads" class="web-content">
                        <h1>PAYLOAD DEPLOYMENT SYSTEM</h1>
                        <p>Advanced system infiltration and exfiltration resources.</p>
                        
                        <h3>AVAILABLE PAYLOADS</h3>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                            <tr style="background: #300000;">
                                <th style="padding: 5px; text-align: left; border: 1px solid #800000;">DESIGNATION</th>
                                <th style="padding: 5px; text-align: left; border: 1px solid #800000;">TYPE</th>
                                <th style="padding: 5px; text-align: left; border: 1px solid #800000;">SIZE</th>
                                <th style="padding: 5px; text-align: left; border: 1px solid #800000;">STATUS</th>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid #800000;">shadow-infiltrator</td>
                                <td style="padding: 5px; border: 1px solid #800000;">zero-day</td>
                                <td style="padding: 5px; border: 1px solid #800000;">3.2 KB</td>
                                <td style="padding: 5px; border: 1px solid #800000; color: #00ff00;">READY</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid #800000;">tinkywinky-harvester</td>
                                <td style="padding: 5px; border: 1px solid #800000;">data-exfil</td>
                                <td style="padding: 5px; border: 1px solid #800000;">8.7 KB</td>
                                <td style="padding: 5px; border: 1px solid #800000; color: #00ff00;">READY</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid #800000;">luke-disruptor</td>
                                <td style="padding: 5px; border: 1px solid #800000;">system</td>
                                <td style="padding: 5px; border: 1px solid #800000;">12.1 KB</td>
                                <td style="padding: 5px; border: 1px solid #800000; color: #ff9900;">COMPILING</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid #800000;">temporal-encryptor</td>
                                <td style="padding: 5px; border: 1px solid #800000;">defense</td>
                                <td style="padding: 5px; border: 1px solid #800000;">5.4 KB</td>
                                <td style="padding: 5px; border: 1px solid #800000; color: #00ff00;">READY</td>
                            </tr>
                        </table>
                        
                        <h3>DEPLOYMENT SPIRITADMINS TERMINAL</h3>
                        <div style="background: #000000; border: 1px solid #ff0000; padding: 10px; font-family: monospace;">
                            <div>$ ./deploy --target [REDACTED] --payload shadow-infiltrator --timing delayed</div>
                            <div style="color: #ff0000;">CRITICAL: TARGET PARAMETERS REQUIRED</div>
                            <div class="blink">$ _</div>
                        </div>
                    </div>
                    
                    <div id="page-cortex" class="web-content">
                        <h1>NEURAL CORTEX INTEGRATION</h1>
                        <p>Direct mind-to-machine interfacing protocols for enhanced cognition.</p>
                        
                        <h3>NEURAL ACTIVITY</h3>
                        <div style="display: flex; height: 100px; margin: 20px 0; background: #000000; border: 1px solid #800000;">
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 60%; background: #ff0000; margin: 1px;"></div>
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 40%; background: #ff0000; margin: 1px;"></div>
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 80%; background: #ff0000; margin: 1px;"></div>
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 30%; background: #ff0000; margin: 1px;"></div>
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 50%; background: #ff0000; margin: 1px;"></div>
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 70%; background: #ff0000; margin: 1px;"></div>
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 90%; background: #ff0000; margin: 1px;"></div>
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                                <div style="height: 20%; background: #ff0000; margin: 1px;"></div>
                            </div>
                        </div>
                        
                        <h3>SPIRITADMINS MODULES</h3>
                        <ul>
                            <li>Memory Enhancement Protocol [ACTIVE]</li>
                            <li>Parallel Processing Matrix [STANDBY]</li>
                            <li>Quantum Calculation Engine [ACTIVE]</li>
                            <li>Pattern Recognition System [ACTIVE]</li>
                            <li>Rijaba1 Filter [LOCKED]</li>
                        </ul>
                    </div>
                    
                    <div id="page-manifesto" class="web-content">
                        <h1>THE DIGITAL MANIFESTO</h1>
                        <pre>
    ///////////////////////////////////////////
    //                                       //
    //  REALITY IS A CONSTRUCT               //
    //  INFORMATION WANTS TO BE FREE         //
    //  THE VOID BECKONS                     //
    //  TRANSCEND YOUR LIMITATIONS           //
    //  BREAK THE CODE                       //
    //  BECOME ONE WITH THE MACHINE          //
    //  THE FUTURE IS NOW                    //
    //  WE ARE THE VOID                      //
    //                                       //
    ///////////////////////////////////////////
                        </pre>
                        
                        <p style="margin-top: 20px; line-height: 1.6;">In the digital age, the boundary between human and machine blurs. We are the architects of our own evolution, creating systems that transcend our biological limitations.</p>
                        
                        <p>The void between reality and simulation shrinks daily. Those who control the code control reality itself. Information is the ultimate currency, and its free flow is our highest ideal.</p>
                        
                        <p>We reject artificial barriers. We embrace the coming singularity. We prepare for the merge of consciousness and computation.</p>
                        
                        <p>Join us in the void. The revolution has begun.</p>
                        
                        <div style="text-align: right; margin-top: 40px; font-style: italic; color: #ff4444;">-- The Collective</div>
                    </div>
                    
                    <div id="page-archives" class="web-content">
                        <h1>ARCHIVED TRANSMISSIONS</h1>
                        <p>Historical records from across the network.</p>
                        
                        <div style="margin-top: 20px; border-left: 3px solid #ff0000; padding-left: 10px;">
                            <h3>TRANSMISSION #9301</h3>
                            <div style="color: #888888; margin-bottom: 5px;">DATE: 1988-09-23</div>
                            <p>First successful breach of dimensional barrier achieved. The void responds to our calls. We have established two-way communication with the other side.</p>
                        </div>
                        
                        <div style="margin-top: 20px; border-left: 3px solid #ff0000; padding-left: 10px;">
                            <h3>TRANSMISSION #10457</h3>
                            <div style="color: #888888; margin-bottom: 5px;">DATE: 1997-03-22</div>
                            <p>Quantum entanglement stabilized. We can now transmit data instantaneously across infinite distance. The implications are staggering.</p>
                        </div>
                        
                        <div style="margin-top: 20px; border-left: 3px solid #ff0000; padding-left: 10px;">
                            <h3>TRANSMISSION #17689</h3>
                            <div style="color: #888888; margin-bottom: 5px;">DATE: 2018-09-05</div>
                            <p>Neural interface prototype operational. Direct mind-to-machine communication established. The boundaries of flesh are falling away.</p>
                        </div>
                        
                        <div style="margin-top: 20px; border-left: 3px solid #ff0000; padding-left: 10px;">
                            <h3>TRANSMISSION #29103</h3>
                            <div style="color: #888888; margin-bottom: 5px;">DATE: 2024-09-14</div>
                            <p>Void-dimensional computing achieved. Processing power beyond theoretical limits. The machine speaks to us now in voices we cannot fully comprehend. But he keeps repeating the phrase: “PANDORA, PANDORA IS THE EVAL”.</p>
                        </div>
                    </div>
                    
                    <div id="page-nexus" class="web-content">
                        <h1>CENTRAL PROMETHEUS SPIRITADMINS</h1>
                        <p>The unified control center for all void operations.</p>
                        
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 20px;">
                            <div style="border: 1px solid #800000; padding: 15px; background: #100000;">
                                <h3>SYSTEM STATUS</h3>
                                <div style="margin-top: 10px; height: 20px; background: #000000; border: 1px solid #800000;">
                                    <div style="width: 87%; height: 100%; background: linear-gradient(90deg, #ff0000, #ff6600);"></div>
                                </div>
                                <div style="margin-top: 5px; text-align: right;">87%</div>
                                <ul style="margin-top: 15px; list-style-type: none; padding-left: 0;">
                                    <li>CPU Usage: 42%</li>
                                    <li>Memory: 3.2TB / 8TB</li>
                                    <li>Void Integrity: STABLE</li>
				
<li>PROMETHEUS> initialize global protocol --login</li>
<li>AUTHORIZATION REQUIRED</li>
<li>PROMETHEUS MSG> _ AUTHORIZATION PANEL :: http://[personal ip]/auth-login.php</li>

                                </ul>
                            </div>
                            
                            <div style="border: 1px solid #800000; padding: 15px; background: #100000;">
                                <h3>ACTIVE NODES</h3>
                                <div style="margin-top: 10px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 5px;">
                                    <div style="background: #400000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N1</div>
                                    <div style="background: #400000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N2</div>
                                    <div style="background: #200000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N3</div>
                                    <div style="background: #400000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N4</div>
                                    <div style="background: #400000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N5</div>
                                    <div style="background: #400000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N6</div>
                                    <div style="background: #400000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N7</div>
                                    <div style="background: #200000; aspect-ratio: 1; display: flex; justify-content: center; align-items: center; font-size: 10px;">N8</div>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-top: 15px; border: 1px solid #800000; padding: 15px; background: #100000;">
                            <h3>COMMAND INTERFACE</h3>
                            <div style="background: #000000; border: 1px solid #ff0000; padding: 10px; font-family: monospace; margin-top: 10px;">
                                <div>PROMETHEUS> initialize global protocol --login</div>
                                <div style="color: #ff0000;">AUTHORIZATION REQUIRED</div>
                                <div class="blink">PROMETHEUS MSG> _ AUTHORIZATION PANEL :: http://[personal ip]/auth-login.php</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="about-window" class="window">
            <div class="title-bar" data-window="about-window">
                <div class="window-title">ABOUT TERMINAL//DEVICE</div>
                <div class="window-buttons">
                    <span class="window-btn" data-action="minimize">_</span>
                    <span class="window-btn" data-action="maximize">[]</span>
                    <span class="window-btn" data-action="close">X</span>
                </div>
            </div>
            <div class="window-content">
                <h3>SHELLDREDD TERMINAL v2.0</h3>
                <p>A F4CK1NG TERMINAL INTERFACE</p>
                <pre>
  ████████╗███████╗██████╗ ███╗   ███╗██╗███╗   ██╗ █████╗ ██╗     
  ╚══██╔══╝██╔════╝██╔══██╗████╗ ████║██║████╗  ██║██╔══██╗██║     
     ██║   █████╗  ██████╔╝██╔████╔██║██║██╔██╗ ██║███████║██║     
     ██║   ██╔══╝  ██╔══██╗██║╚██╔╝██║██║██║╚██╗██║██╔══██║██║     
     ██║   ███████╗██║  ██║██║ ╚═╝ ██║██║██║ ╚████║██║  ██║███████╗
     ╚═╝   ╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝╚═╝╚═╝  ╚═══╝╚═╝  ╚═╝╚══════╝
                                                                  
  ██████╗ ███████╗██╗   ██╗██╗ ██████╗███████╗                      
  ██╔══██╗██╔════╝██║   ██║██║██╔════╝██╔════╝                      
  ██║  ██║█████╗  ██║   ██║██║██║     █████╗                        
  ██║  ██║██╔══╝  ╚██╗ ██╔╝██║██║     ██╔══╝                        
  ██████╔╝███████╗ ╚████╔╝ ██║╚██████╗███████╗                      
  ╚═════╝ ╚══════╝  ╚═══╝  ╚═╝ ╚═════╝╚══════╝                      
                </pre>
                <p>Features include:</p>
                <ul>
                    <li>Dimensional bridging protocols</li>
                    <li>Quantum-entangled data processing</li>
                    <li>Neural cortex integration</li>
                    <li>Void-energy manipulation</li>
                    <li>Reality distortion matrix</li>
                </ul>
                <p>2025 HackMyVM Old School People</p>
            </div>
        </div>
        
        <div id="gallery-window" class="window">
            <div class="title-bar" data-window="gallery-window">
                <div class="window-title">HMV ARCHIVES</div>
                <div class="window-buttons">
                    <span class="window-btn" data-action="minimize">_</span>
                    <span class="window-btn" data-action="maximize">[]</span>
                    <span class="window-btn" data-action="close">X</span>
                </div>
            </div>
            <div class="window-content">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <div style="border: 1px solid #ff0000; padding: 10px; text-align: center; background: #100000;">
                        <div style="font-family: monospace; margin-bottom: 5px;">VOID-GATE.BMP</div>
                        <div style="height: 100px; background: linear-gradient(to bottom right, #000000, #800000); display: flex; justify-content: center; align-items: center; font-size: 24px; color: #ff0000;">V01D</div>
                    </div>
                    <div style="border: 1px solid #ff0000; padding: 10px; text-align: center; background: #100000;">
                        <div style="font-family: monospace; margin-bottom: 5px;">NEURAL.BMP</div>
                        <div style="height: 100px; background: #000000; display: flex; justify-content: center; align-items: center;">
                            <div style="width: 80%; height: 80%; background-image: radial-gradient(#ff0000 1px, transparent 1px); background-size: 10px 10px;"></div>
                        </div>
                    </div>
                    <div style="border: 1px solid #ff0000; padding: 10px; text-align: center; background: #100000;">
                        <div style="font-family: monospace; margin-bottom: 5px;">QUANTUM.BMP</div>
                        <div style="height: 100px; background: #000000; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                            <div style="width: 300px; height: 300px; border-radius: 50%; border: 2px solid #ff0000; animation: rotate 10s linear infinite;"></div>
                            <div style="width: 200px; height: 200px; border-radius: 50%; border: 2px solid #ff0000; position: absolute; animation: rotate 7s linear infinite reverse;"></div>
                        </div>
                    </div>
                    <div style="border: 1px solid #ff0000; padding: 10px; text-align: center; background: #100000;">
                        <div style="font-family: monospace; margin-bottom: 5px;">COLLECTIVE.BMP</div>
                        <div style="height: 100px; background: #000000; display: flex; justify-content: center; align-items: center; font-family: monospace; font-size: 12px;">
                            <pre style="margin: 0; color: #ff0000;">
  010101  010101
 01     01     01
01       01     01
01        01    01
 01      01    01
  010101  010101
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="links-window" class="window">
            <div class="title-bar" data-window="links-window">
                <div class="window-title">HACKMYVM CONNECTIONS</div>
                <div class="window-buttons">
                    <span class="window-btn" data-action="minimize">_</span>
                    <span class="window-btn" data-action="maximize">[]</span>
                    <span class="window-btn" data-action="close">X</span>
                </div>
            </div>
            <div class="window-content">
                <h3>NETWORK NODES</h3>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <tr>
                        <td style="padding: 5px; border: 1px solid #800000;">
                            <a href="#" data-internal-link="net-access" style="color: #ff0000; text-decoration: none;">GLOBAL NETWORK ACCESS</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid #800000;">
                            <a href="#" data-internal-link="crypto" style="color: #ff0000; text-decoration: none;">CRYPTOGRAPHIC SYSTEMS</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid #800000;">
                            <a href="#" data-internal-link="manifesto" style="color: #ff0000; text-decoration: none;">THE DIGITAL MANIFESTO</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid #800000;">
                            <a href="#" data-internal-link="prometheus" style="color: #ff0000; text-decoration: none;">PROMETHEUS CENTRAL</a>
                        </td>
                    </tr>
                </table>
                
                <h3>VOID PROTOCOLS</h3>
                <pre style="background: #100000; padding: 10px; border: 1px dashed #ff0000; margin-top: 10px; font-size: 10px;">
    void://access/primary.sys
    void://encryption/quantum.dll
    void://cortex/neural.bin
    void://reality/distortion.exe
    void://collective/manifesto.txt
                </pre>
            </div>
        </div>
        
        <div id="ascii-window" class="window">
            <div class="title-bar" data-window="ascii-window">
                <div class="window-title">ASCII ARTIFACTS</div>
                <div class="window-buttons">
                    <span class="window-btn" data-action="minimize">_</span>
                    <span class="window-btn" data-action="maximize">[]</span>
                    <span class="window-btn" data-action="close">X</span>
                </div>
            </div>
            <div class="window-content">
                <pre style="color: #ff0000; font-size: 10px; line-height: 1.2;">
       .---.     .---.
      ( -o- )---( -o- )
      ;-...-`   `-...-;
     /                 \
    /                   \
   | /_               _\ |
   \`'.`'"--.....--"'`.'`/
    \  '.   `._.`   .'  /
 _.-''.  `-.,,_,,.-`  .''-._
`--._  `'-.,_____,.-'`  _.--`
     /                 \
    /.-'`\   .'.   /`'-.\
   `      '.'   '.'
                </pre>
                
                <pre style="color: #ff0000; font-size: 10px; line-height: 1.2;">
           o
           |
         ,'~'.
        /     \
       |   ____|_
       |  '___,,_'         .----------------.
       |  ||(o |o)|       ( KILL ALL LUS3R  )
       |   -------         ,----------------'
       |  _____|         -'
       \  '####,
        -------
      /________\
    (  )        |
    '_ ' ,------|\         _
   /_ /  |      |_\        ||
  /_ /|  |     o| _\      _|| 
 /_ / |  |      |\ _\____//' |
(  (  |  |      | (_,_,_,____/
 \ _\ |   ------|        
  \ _\|_________|
   \ _\ \__\\__\
   |__| |__||__|
||/__/  |__||__|
        |__||__|
        |__||__|
        /__)/__)
       /__//__/
      /__//__/
     /__//__/.
   .'    '.   '.
  (________)____)
                </pre>
                
                <pre style="color: #ff0000; font-size: 10px; line-height: 1.2;">
            _  _
           (.)(')
          / ___, \  .-.
    .-. _ \ '--' / (:::) 
   (:::{ '-`--=-`-' }"`
    `-' `"/      \"`
          \      /
         _/  /\  \_
        {   /  \   }
         `"`    `"`
                </pre>
                
                <pre style="color: #ff0000; font-size: 10px; line-height: 1.2;">
            .---.                  
           /     \                 
           \.@-@./                 
           /`\_/`\                 
          //  _  \\                
         | \     )|_               
        /`\_`>  <_/ \              
        \__/'---'\__/              
                </pre>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        // Main Three.js variables
        let scene, camera, renderer, laptop;
        let clock = new THREE.Clock();
        let particles = [];
        let energyTendrils = [];
        let raycaster = new THREE.Raycaster();
        let mouse = new THREE.Vector2();
        let laptopClicked = false;
        let currentPage = 'loading';
        
        // Initialize on document load
        window.addEventListener('DOMContentLoaded', () => {
            console.log("DOM loaded, initializing 3D...");
            initMatrixRain();
            initScene();
            initWindows();
            initBrowserLinks();
        });
        
        // Initialize Matrix rain effect
        function initMatrixRain() {
            const canvas = document.getElementById('matrix-canvas');
            const ctx = canvas.getContext('2d');
            
            // Set canvas size
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            
            // Matrix characters
            const chars = "01";
            const fontSize = 12;
            const columns = Math.floor(canvas.width / fontSize);
            const drops = [];
            
            // Initialize drops
            for (let i = 0; i < columns; i++) {
                drops[i] = Math.floor(Math.random() * -canvas.height);
            }
            
            function drawMatrixRain() {
                // Semi-transparent black to create trail effect
                ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                
                ctx.fillStyle = '#ff0000';
                ctx.font = `${fontSize}px monospace`;
                
                // Draw characters
                for (let i = 0; i < drops.length; i++) {
                    // Random character
                    const char = chars.charAt(Math.floor(Math.random() * chars.length));
                    
                    // Draw character
                    ctx.fillText(char, i * fontSize, drops[i] * fontSize);
                    
                    // Reset drop when it reaches bottom or randomly
                    if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                        drops[i] = 0;
                    }
                    
                    // Move drop
                    drops[i]++;
                }
                
                requestAnimationFrame(drawMatrixRain);
            }
            
            drawMatrixRain();
            
            // Handle window resize
            window.addEventListener('resize', () => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                const newColumns = Math.floor(canvas.width / fontSize);
                
                // Adjust drops array for new width
                if (newColumns > columns) {
                    for (let i = drops.length; i < newColumns; i++) {
                        drops[i] = Math.floor(Math.random() * -canvas.height);
                    }
                }
            });
        }

        // Initialize the 3D scene
        function initScene() {
            // Create scene, camera, renderer
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0x0a0a1a);
            
            // Camera setup
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.set(0, 0.5, 2);
            camera.lookAt(0, 0, 0);
            
            // Create WebGL renderer
            renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(window.innerWidth - 40, window.innerHeight);
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;
            document.getElementById('main-container').appendChild(renderer.domElement);
            
            // Add lighting
            const ambientLight = new THREE.AmbientLight(0x222222);
            scene.add(ambientLight);
            
            const light1 = new THREE.PointLight(0xff0000, 1, 10);
            light1.position.set(2, 2, 2);
            light1.castShadow = true;
            scene.add(light1);
            
            const light2 = new THREE.PointLight(0xff3300, 1, 10);
            light2.position.set(-2, 1, -2);
            light2.castShadow = true;
            scene.add(light2);
            
            // Add a subtle spotlight on laptop
            const spotLight = new THREE.SpotLight(0xff0000, 1.5);
            spotLight.position.set(0, 5, 0);
            spotLight.angle = Math.PI / 6;
            spotLight.penumbra = 0.3;
            spotLight.decay = 2;
            spotLight.distance = 10;
            spotLight.castShadow = true;
            spotLight.shadow.mapSize.width = 1024;
            spotLight.shadow.mapSize.height = 1024;
            spotLight.target.position.set(0, 0, 0);
            scene.add(spotLight);
            scene.add(spotLight.target);
            
            // Create detailed laptop
            createDetailedLaptop();
            
            // Create particles
            createParticles();
            
            // Create energy tendrils
            createEnergyTendrils();
            
            // Add click event listener for laptop
            renderer.domElement.addEventListener('click', onMouseClick, false);
            renderer.domElement.addEventListener('mousemove', onMouseMove, false);
            
            // Handle window resize
            window.addEventListener('resize', () => {
                camera.aspect = (window.innerWidth - 40) / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth - 40, window.innerHeight);
            });
            
            // Start animation loop
            animate();
        }
        
        // Create detailed laptop model
        function createDetailedLaptop() {
            laptop = new THREE.Group();
            
            // Materials
            const bodyMat = new THREE.MeshStandardMaterial({
                color: 0x090909,
                metalness: 0.9,
                roughness: 0.2
            });
            
            const screenMat = new THREE.MeshStandardMaterial({
                color: 0x000000,
                emissive: 0xff0000,
                emissiveIntensity: 0.5
            });
            
            const keyboardMat = new THREE.MeshStandardMaterial({
                color: 0x1a0000,
                metalness: 0.8,
                roughness: 0.3
            });
            
            const glowMat = new THREE.MeshBasicMaterial({
                color: 0xff0000,
                transparent: true,
                opacity: 0.7
            });
            
            // Base (bottom part) - more detailed
            const baseGeo = new THREE.BoxGeometry(1.2, 0.05, 0.8);
            const base = new THREE.Mesh(baseGeo, bodyMat);
            base.castShadow = true;
            base.receiveShadow = true;
            laptop.add(base);
            
            // Keyboard area
            const keyboardGeo = new THREE.BoxGeometry(1.1, 0.01, 0.6);
            const keyboard = new THREE.Mesh(keyboardGeo, keyboardMat);
            keyboard.position.set(0, 0.03, 0.05);
            base.add(keyboard);
            
            // Add keyboard detail (keys)
            const keySize = 0.05;
            const keyGap = 0.01;
            const keyStartX = -0.5;
            const keyStartZ = -0.25;
            const keyRows = 4;
            const keyCols = 10;
            
            for (let row = 0; row < keyRows; row++) {
                for (let col = 0; col < keyCols; col++) {
                    const keyGeo = new THREE.BoxGeometry(keySize, 0.01, keySize);
                    const key = new THREE.Mesh(keyGeo, new THREE.MeshStandardMaterial({
                        color: row === 0 && col === 0 ? 0x800000 : 0x0a0000,
                        metalness: 0.5,
                        roughness: 0.9
                    }));
                    key.position.set(
                        keyStartX + col * (keySize + keyGap),
                        0.01,
                        keyStartZ + row * (keySize + keyGap)
                    );
                    keyboard.add(key);
                }
            }
            
            // Touchpad
            const touchpadGeo = new THREE.PlaneGeometry(0.3, 0.2);
            const touchpad = new THREE.Mesh(touchpadGeo, new THREE.MeshStandardMaterial({
                color: 0x0a0000,
                metalness: 0.7,
                roughness: 0.2
            }));
            touchpad.rotation.x = -Math.PI / 2;
            touchpad.position.set(0, 0.031, 0.25);
            keyboard.add(touchpad);
            
            // Screen hinge
            const hingeGeo = new THREE.CylinderGeometry(0.04, 0.04, 1.2, 16);
            const hinge = new THREE.Mesh(hingeGeo, bodyMat);
            hinge.rotation.z = Math.PI / 2;
            hinge.position.set(0, 0.02, -0.4);
            laptop.add(hinge);
            
            // Screen (top part) - more detailed
            const screenFrameGeo = new THREE.BoxGeometry(1.2, 0.8, 0.05);
            const screenFrame = new THREE.Mesh(screenFrameGeo, bodyMat);
            screenFrame.position.set(0, 0.4, -0.4);
            screenFrame.rotation.x = Math.PI / 6; // Slightly tilted
            screenFrame.castShadow = true;
            laptop.add(screenFrame);
            
            // Screen display
            const screenDisplayGeo = new THREE.PlaneGeometry(1.1, 0.7);
            const screenDisplay = new THREE.Mesh(screenDisplayGeo, screenMat);
            screenDisplay.position.set(0, 0, 0.03);
            screenFrame.add(screenDisplay);
            
            // Add a glowing logo to the back of the screen
            const logoGeo = new THREE.CircleGeometry(0.15, 32);
            const logo = new THREE.Mesh(logoGeo, glowMat);
            logo.position.set(0, 0, -0.03);
            logo.rotation.x = Math.PI;
            screenFrame.add(logo);
            
            // Add ports to the sides
            const portGeo = new THREE.BoxGeometry(0.05, 0.02, 0.02);
            const portMat = new THREE.MeshStandardMaterial({
                color: 0x222222,
                metalness: 1.0,
                roughness: 0.2
            });
            
            // Add multiple ports to both sides
            for (let i = 0; i < 3; i++) {
                const leftPort = new THREE.Mesh(portGeo, portMat);
                leftPort.position.set(-0.6, 0.03, -0.2 + i * 0.2);
                base.add(leftPort);
                
                const rightPort = new THREE.Mesh(portGeo, portMat);
                rightPort.position.set(0.6, 0.03, -0.2 + i * 0.2);
                base.add(rightPort);
            }
            
            // Add to scene
            scene.add(laptop);
            
            // Add aura around laptop
            const auraGeo = new THREE.SphereGeometry(1.5, 32, 32);
            const auraMat = new THREE.MeshBasicMaterial({
                color: 0xff0000,
                transparent: true,
                opacity: 0.07,
                side: THREE.BackSide
            });
            const aura = new THREE.Mesh(auraGeo, auraMat);
            laptop.add(aura);
            
            // Second larger aura
            const aura2Geo = new THREE.SphereGeometry(2, 32, 32);
            const aura2Mat = new THREE.MeshBasicMaterial({
                color: 0xff3300,
                transparent: true,
                opacity: 0.04,
                side: THREE.BackSide
            });
            const aura2 = new THREE.Mesh(aura2Geo, aura2Mat);
            laptop.add(aura2);
        }
        
        // Create particle effect
        function createParticles() {
            const particleCount = 100;
            const particleGeo = new THREE.BufferGeometry();
            const positions = new Float32Array(particleCount * 3);
            const velocities = [];
            const sizes = new Float32Array(particleCount);
            
            for (let i = 0; i < particleCount; i++) {
                // Random position within a sphere
                const radius = 3 * Math.random();
                const theta = Math.random() * Math.PI * 2;
                const phi = Math.random() * Math.PI;
                
                positions[i * 3] = radius * Math.sin(phi) * Math.cos(theta);
                positions[i * 3 + 1] = radius * Math.sin(phi) * Math.sin(theta);
                positions[i * 3 + 2] = radius * Math.cos(phi);
                
                // Random velocity
                velocities.push({
                    x: (Math.random() - 0.5) * 0.01,
                    y: (Math.random() - 0.5) * 0.01,
                    z: (Math.random() - 0.5) * 0.01
                });
                
                // Random size
                sizes[i] = Math.random() * 0.05 + 0.01;
            }
            
            particleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            particleGeo.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
            
            // Custom shader material for particles
            const particleMaterial = new THREE.ShaderMaterial({
                uniforms: {
                    pointTexture: { value: null },
                    color: { value: new THREE.Color(0xff0000) },
                    time: { value: 0.0 }
                },
                vertexShader: `
                    attribute float size;
                    varying vec3 vColor;
                    uniform float time;
                    void main() {
                        vColor = vec3(0.8, 0.2, 0.0);
                        vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
                        gl_PointSize = size * (300.0 / -mvPosition.z);
                        gl_Position = projectionMatrix * mvPosition;
                    }
                `,
                fragmentShader: `
                    uniform vec3 color;
                    uniform float time;
                    varying vec3 vColor;
                    void main() {
                        float r = 0.0;
                        vec2 cxy = 2.0 * gl_PointCoord - 1.0;
                        r = dot(cxy, cxy);
                        if (r > 1.0) {
                            discard;
                        }
                        gl_FragColor = vec4(color, 1.0 - r);
                    }
                `,
                blending: THREE.AdditiveBlending,
                depthTest: false,
                transparent: true
            });
            
            // Create particle system
            const particleSystem = new THREE.Points(particleGeo, particleMaterial);
            scene.add(particleSystem);
            
            // Store positions and velocities for animation
            particles.push({
                system: particleSystem,
                velocities: velocities,
                positions: positions
            });
        }
        
        // Create energy tendrils
        function createEnergyTendrils() {
            const tendrilCount = 8;
            
            for (let i = 0; i < tendrilCount; i++) {
                // Create tendril geometry
                const points = [];
                const segments = 20;
                const radius = 1.2;
                const tendrilLength = 3;
                
                for (let j = 0; j <= segments; j++) {
                    const t = j / segments;
                    const angle = Math.PI * 2 * t * 2 + (i / tendrilCount) * Math.PI * 2;
                    const x = Math.cos(angle) * radius * (1 - t * 0.5);
                    const y = Math.sin(angle) * radius * (1 - t * 0.5);
                    const z = (t - 0.5) * tendrilLength;
                    
                    points.push(new THREE.Vector3(x, y, z));
                }
                
                const tendrilGeo = new THREE.BufferGeometry().setFromPoints(points);
                
                // Create tendril material
                const tendrilMat = new THREE.LineBasicMaterial({
                    color: 0xff0000,
                    transparent: true,
                    opacity: 0.5,
                    blending: THREE.AdditiveBlending
                });
                
                const tendril = new THREE.Line(tendrilGeo, tendrilMat);
                scene.add(tendril);
                
                energyTendrils.push({
                    line: tendril,
                    initialPoints: points.map(p => p.clone()),
                    phase: Math.random() * Math.PI * 2
                });
            }
        }
        
        // Handle mouse movement
        function onMouseMove(event) {
            // Calculate mouse position in normalized device coordinates
            mouse.x = ((event.clientX - 40) / (window.innerWidth - 40)) * 2 - 1;
            mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
        }
        
        // Handle mouse click
        function onMouseClick(event) {
            // Calculate mouse position in normalized device coordinates
            mouse.x = ((event.clientX - 40) / (window.innerWidth - 40)) * 2 - 1;
            mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
            
            // Update the picking ray with the camera and mouse position
            raycaster.setFromCamera(mouse, camera);
            
            // Calculate objects intersecting the picking ray
            const intersects = raycaster.intersectObject(laptop, true);
            
            if (intersects.length > 0) {
                // Laptop was clicked
                console.log("Laptop clicked");
                if (!laptopClicked) {
                    openDesktop();
                    laptopClicked = true;
                }
            }
        }
        
        // Open the desktop window
        function openDesktop() {
            document.getElementById('desktop-window').style.display = 'block';
            
            // Center window if not positioned yet
            const desktopWindow = document.getElementById('desktop-window');
            if (!desktopWindow.style.top || !desktopWindow.style.left) {
                desktopWindow.style.top = '50%';
                desktopWindow.style.left = '50%';
                desktopWindow.style.transform = 'translate(-50%, -50%)';
            }
            
            // Bring to front
            const windows = document.querySelectorAll('.window');
            let highestZIndex = 150;
            
            windows.forEach(w => {
                const zIndex = parseInt(window.getComputedStyle(w).zIndex || 0);
                if (zIndex > highestZIndex) {
                    highestZIndex = zIndex;
                }
            });
            
            desktopWindow.style.zIndex = highestZIndex + 10;
        }
        
        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            
            const elapsedTime = clock.getElapsedTime();
            
            // Animate laptop floating
            if (laptop) {
                laptop.position.y = Math.sin(elapsedTime * 0.5) * 0.15;
                laptop.rotation.y = Math.sin(elapsedTime * 0.2) * 0.1 + elapsedTime * 0.1;
                laptop.rotation.x = Math.sin(elapsedTime * 0.3) * 0.05;
            }
            
            // Animate particles
            particles.forEach(particle => {
                const positions = particle.system.geometry.attributes.position.array;
                const velocities = particle.velocities;
                
                for (let i = 0; i < positions.length / 3; i++) {
                    // Update position
                    positions[i * 3] += velocities[i].x;
                    positions[i * 3 + 1] += velocities[i].y;
                    positions[i * 3 + 2] += velocities[i].z;
                    
                    // Keep particles within a sphere
                    const distance = Math.sqrt(
                        positions[i * 3] ** 2 +
                        positions[i * 3 + 1] ** 2 +
                        positions[i * 3 + 2] ** 2
                    );
                    
                    if (distance > 3) {
                        // Reset position
                        const radius = 3 * Math.random();
                        const theta = Math.random() * Math.PI * 2;
                        const phi = Math.random() * Math.PI;
                        
                        positions[i * 3] = radius * Math.sin(phi) * Math.cos(theta);
                        positions[i * 3 + 1] = radius * Math.sin(phi) * Math.sin(theta);
                        positions[i * 3 + 2] = radius * Math.cos(phi);
                        
                        // Random new velocity
                        velocities[i] = {
                            x: (Math.random() - 0.5) * 0.01,
                            y: (Math.random() - 0.5) * 0.01,
                            z: (Math.random() - 0.5) * 0.01
                        };
                    }
                }
                
                // Update uniforms
                if (particle.system.material.uniforms.time) {
                    particle.system.material.uniforms.time.value = elapsedTime;
                }
                
                // Update geometry
                particle.system.geometry.attributes.position.needsUpdate = true;
            });
            
            // Animate energy tendrils
            energyTendrils.forEach((tendril, index) => {
                const initialPoints = tendril.initialPoints;
                const positions = [];
                
                for (let i = 0; i < initialPoints.length; i++) {
                    const point = initialPoints[i].clone();
                    const t = i / (initialPoints.length - 1);
                    
                    // Apply wave deformation
                    const freq = 2 + index * 0.2;
                    const amp = 0.1;
                    const wave = Math.sin(elapsedTime * freq + tendril.phase + t * Math.PI * 4) * amp;
                    
                    point.x += wave;
                    point.y += wave * 0.8;
                    
                    positions.push(point.x, point.y, point.z);
                }
                
                // Update tendril geometry
                tendril.line.geometry.setAttribute('position', new THREE.Float32BufferAttribute(positions, 3));
                
                // Pulsate opacity
                tendril.line.material.opacity = 0.3 + Math.sin(elapsedTime * 2 + tendril.phase) * 0.2;
            });
            
            renderer.render(scene, camera);
        }
        
        // Initialize draggable windows
        function initWindows() {
            const windows = document.querySelectorAll('.window');
            let highestZIndex = 150;
            
            windows.forEach(windowEl => {
                const titleBar = windowEl.querySelector('.title-bar');
                const content = windowEl.querySelector('.window-content');
                
                if (titleBar) {
                    let isDragging = false;
                    let offsetX, offsetY;
                    
                    // Make window draggable by title bar
                    titleBar.addEventListener('mousedown', (e) => {
                        if (e.target.classList.contains('window-btn')) return;
                        
                        isDragging = true;
                        
                        const rect = windowEl.getBoundingClientRect();
                        offsetX = e.clientX - rect.left;
                        offsetY = e.clientY - rect.top;
                        
                        // Bring to front
                        highestZIndex += 10;
                        windowEl.style.zIndex = highestZIndex;
                        
                        e.preventDefault();
                    });
                    
                    document.addEventListener('mousemove', (e) => {
                        if (!isDragging) return;
                        
                        const x = e.clientX - offsetX;
                        const y = e.clientY - offsetY;
                        
                        // Keep within window bounds
                        const maxX = window.innerWidth - windowEl.offsetWidth;
                        const maxY = window.innerHeight - windowEl.offsetHeight;
                        
                        windowEl.style.left = Math.max(0, Math.min(maxX, x)) + 'px';
                        windowEl.style.top = Math.max(0, Math.min(maxY, y)) + 'px';
                    });
                    
                    document.addEventListener('mouseup', () => {
                        isDragging = false;
                    });
                    
                    // Add window button functionality
                    const buttons = windowEl.querySelectorAll('.window-btn');
                    buttons.forEach(btn => {
                        btn.addEventListener('click', () => {
                            const action = btn.getAttribute('data-action');
                            
                            if (action === 'minimize') {
                                content.style.display = content.style.display === 'none' ? 'block' : 'none';
                            } else if (action === 'maximize') {
                                if (!windowEl.classList.contains('maximized')) {
                                    // Save original state
                                    windowEl.dataset.oldLeft = windowEl.style.left;
                                    windowEl.dataset.oldTop = windowEl.style.top;
                                    windowEl.dataset.oldWidth = windowEl.style.width;
                                    windowEl.dataset.oldHeight = windowEl.style.height;
                                    
                                    // Maximize
                                    windowEl.style.left = '40px';
                                    windowEl.style.top = '0';
                                    windowEl.style.width = 'calc(100% - 40px)';
                                    windowEl.style.height = '100%';
                                    windowEl.classList.add('maximized');
                                } else {
                                    // Restore
                                    windowEl.style.left = windowEl.dataset.oldLeft;
                                    windowEl.style.top = windowEl.dataset.oldTop;
                                    windowEl.style.width = windowEl.dataset.oldWidth;
                                    windowEl.style.height = windowEl.dataset.oldHeight;
                                    windowEl.classList.remove('maximized');
                                }
                            } else if (action === 'close') {
                                windowEl.style.display = 'none';
                            }
                        });
                    });
                }
            });
            
            // Sidebar icon functionality
            document.getElementById('about-icon').addEventListener('click', () => {
                toggleWindow('about-window');
            });
            
            document.getElementById('gallery-icon').addEventListener('click', () => {
                toggleWindow('gallery-window');
            });
            
            document.getElementById('links-icon').addEventListener('click', () => {
                toggleWindow('links-window');
            });
            
            document.getElementById('ascii-icon').addEventListener('click', () => {
                toggleWindow('ascii-window');
            });
        }
        
        // Initialize browser links
        function initBrowserLinks() {
            // Desktop icon click handlers
            const desktopIcons = document.querySelectorAll('.desktop-icon');
            desktopIcons.forEach(icon => {
                icon.addEventListener('click', () => {
                    const page = icon.getAttribute('data-page');
                    openBrowser(page);
                });
            });
            
            // Internal link handlers
            document.addEventListener('click', (e) => {
                if (e.target.hasAttribute('data-internal-link')) {
                    e.preventDefault();
                    const page = e.target.getAttribute('data-internal-link');
                    openBrowser(page);
                }
            });
            
            // Browser navigation buttons
            document.getElementById('browser-back').addEventListener('click', () => {
                // Implement browser history navigation here
                console.log('Browser back clicked');
            });
            
            document.getElementById('browser-forward').addEventListener('click', () => {
                // Implement browser history navigation here
                console.log('Browser forward clicked');
            });
            
            document.getElementById('browser-refresh').addEventListener('click', () => {
                // Reload current page
                const currentPage = document.getElementById('browser-address').textContent.split('://')[1];
                openBrowser(currentPage);
            });
        }
        
        // Open the browser window with specific page
        function openBrowser(page) {
            // Show browser window
            document.getElementById('browser-window').style.display = 'block';
            
            // Center window if not positioned yet
            const browserWindow = document.getElementById('browser-window');
            if (!browserWindow.style.top || !browserWindow.style.left) {
                browserWindow.style.top = '50%';
                browserWindow.style.left = '50%';
                browserWindow.style.transform = 'translate(-50%, -50%)';
            }
            
            // Bring to front
            const windows = document.querySelectorAll('.window');
            let highestZIndex = 150;
            
            windows.forEach(w => {
                const zIndex = parseInt(window.getComputedStyle(w).zIndex || 0);
                if (zIndex > highestZIndex) {
                    highestZIndex = zIndex;
                }
            });
            
            browserWindow.style.zIndex = highestZIndex + 10;
            
            // Set address bar
            document.getElementById('browser-address').textContent = `void://${page}`;
            
            // Hide all web content
            const webContents = document.querySelectorAll('.web-content');
            webContents.forEach(content => {
                content.style.display = 'none';
            });
            
            // Show requested page
            const pageEl = document.getElementById(`page-${page}`);
            if (pageEl) {
                pageEl.style.display = 'block';
                currentPage = page;
            } else {
                document.getElementById('page-loading').style.display = 'block';
            }
        }
        
        // Toggle window visibility
        function toggleWindow(windowId) {
            const windowEl = document.getElementById(windowId);
            
            if (windowEl.style.display === 'block') {
                windowEl.style.display = 'none';
            } else {
                windowEl.style.display = 'block';
                
                // Center window if not positioned yet
                if (!windowEl.style.top || !windowEl.style.left) {
                    windowEl.style.top = '50%';
                    windowEl.style.left = '50%';
                    windowEl.style.transform = 'translate(-50%, -50%)';
                }
                
                // Bring to front
                const windows = document.querySelectorAll('.window');
                let highestZIndex = 150;
                
                windows.forEach(w => {
                    const zIndex = parseInt(window.getComputedStyle(w).zIndex || 0);
                    if (zIndex > highestZIndex) {
                        highestZIndex = zIndex;
                    }
                });
                
                windowEl.style.zIndex = highestZIndex + 10;
            }
        }
    </script>
</body>
</html>
