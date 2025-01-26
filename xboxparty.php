


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <script src="../detectDevTools_obfus.js"></script>

    <meta name="description" content="Endless Products offers a range of tools and services including VPNs, Xbox tools, sniffers, stressers, and more. Explore our solutions for enhanced security and performance.">
    <meta property="og:title" content="Endless Products">
    <meta property="og:description" content="Explore our range of tools and services including VPNs, Xbox tools, sniffers, and more.">
    <meta property="og:url" content="https://everlastingaio.xyz/">
    <link rel="stylesheet" href="../notify.css" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <title>Endless Products</title>

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            overflow-y: auto;
            color: white;
            font-family: Arial, sans-serif;
            background: linear-gradient(270deg, #4B0082, #000000);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .top-bar {
            width: 100%;
            background-color: BlueViolet;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        #center-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 120px; /* Space for top bar */
            width: 80%;
            max-width: 1200px;
        }

        .input-container {
            width: 90%;
            display: flex;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .input-container input {
            width: auto;
            padding: 12px;
            font-size: 16px;
            border: none;
            background-color: #8a2be2;
            color: white;
            border-radius: 5px;
        }

        #center-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 120px; 
            width: 100%;
            max-width: 1200px;
        }

        table {
            width: 90%;
            max-width: 1200px; 
            margin: 0 15px; 
            border-collapse: collapse;
            color: #ddd;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid white;
            text-align: left;
        }

        th {
            background-color: rgba(75, 0, 130, 0.8);
            font-size: 18px;
        }

        td {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .hideDiv {
                
            }
        
        @media (max-width: 768px) {
            .hideDiv {
                display:none!important;
            }
        }





        #btns {
    width: 90%;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap; 
    background: transparent;
    padding: 15px;
    box-sizing: border-box;
}

#btns button {
    background: mediumpurple;
    border: none;
    padding: 8px;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-family: monospace;
    transition: background 0.3s ease;
    flex: 0 1 150px;
    margin: 5px;
    max-width: 100%; 
}

#btns button:hover {
    background: #603fa4;
}

@media (max-width: 768px) {
    #btns {
        flex-direction: column;
        align-items: center;
    }

    #btns button {
        width: 100%;
        margin-bottom: 10px;
        max-width: none; 
        flex: 0 1 40px!important;
    }
}
input {
    margin-top:15px;
            width: 100%; 
            padding: 10px;
            border: 2px solid indigo;
            border-radius: 5px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            box-shadow: 0 0 10px indigo;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input:hover {
            border-color: red; /* Hover effect for border */
            box-shadow: 0 0 20px red; /* Neon effect on hover */
        }
        input:focus {
            border-color: white;
            box-shadow: 0 0 20px white;
            outline: none;
        }
    </style>
</head>
<body onload="checkAuth(),RefreshParty()">
    <script>
    function checkAuth() {
        const expires = localStorage.getItem('authExpires');
        if (!expires || Math.floor(Date.now() / 1000) > expires) {
            window.location.href = 'xbox.php';
        }
    }
    </script>
    
    <div class="top-bar">
        <a href="index.php">Home</a>
        <a href="https://t.me/zurgpower/4">Help</a>
    </div>
    
    <div id="center-block">
        <div class="input-container">
            <input disabled id="hostbox" type="text" value="Host: N/A">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Gamertag</th>
                    <th>Xuid</th>
                    <th>IP Address</th>
                    <th class="hideDiv">Presence</th>
                </tr>
            </thead>
            <tbody id="partyRows">
            <tr>
                <td>n/a</td>
                <td>n/a</td>
                <td>n/a</td>
                <td>n/a</td>
            </tr>
            </tbody>
        </table>
        <div style="margin-top: 10px;" id="PartyDetails">
            Clients in Party: N/A | Party Privacy: N/A | Party Visibility: N/A
        </div>
        <div id="btns">
            <button onclick="RefreshParty()">Refresh</button>
            <button onclick="ActionBtn('crash_party')">Crash Party</button>       
            <button onclick="ActionBtn('unkickable')">Become Unkickable</button>       
            <button onclick="ActionBtn('crash_host')">Crash Host</button>       
            <button onclick="ActionBtn('appear_connecting')">Appear Connecting</button>       
            <button onclick="ActionBtn('appear_disconnecting')">Appear Disconnected</button>       
            <button onclick="ActionBtn('appear_connected')">Appear Connected</button>       
            <button onclick="ActionBtn('hide_party')">Hide Party</button>       
            <button onclick="ActionBtn('uhide_party')">Unhide Party</button>       
            <button onclick="ActionBtn('party_joinable')">Set Joinable</button>       
            <button onclick="ActionBtn('party_inviteOnly')">Set Invite-Only</button>       
            <button onclick="ActionBtn('party_disable_join')">Disable Invites</button>       
            <button onclick="ActionBtn('exit_party')">Exit Party</button>
            <button onclick="ShowPanel()">Change Party Icon</button>
        </div>

        <div style="display:none;    width: 80%;" id="panel">
            <input onkeyup="Search()" type="text" id="icon-search" name="icon-search" placeholder="Enter Game Name">

            <div id="icons">

            </div>
        </div>
    </div>
</body>



    <script>
    /// Hello ZOPZ, you are a bitch. Good luck skidding this now.
    function unixtime() {
        return Math.floor(Date.now() / 1000);
    }

    function handleResponse(data) {
        if (data.success) {
            document.getElementById('partyRows').innerHTML = data.html;
            document.getElementById('hostbox').value = "Host: " + data.host;
            document.getElementById('PartyDetails').innerHTML = data.PartyDetails;

        } else {
            document.getElementById('partyRows').innerHTML = "<tr> <td>n/a</td> <td>n/a</td> <td>n/a</td> <td class='hideDiv'>n/a</td> </tr>";
            document.getElementById('PartyDetails').innerHTML = 'Clients in Party: N/A | Party Privacy: N/A | Party Visibility: N/A';
            showError(data.message);
        }
    }

    function handleError() {
        showError("Error With API!");
    }

    function showError(message) {
        new Notify({
            status: "error",
            title: "Error!",
            text: message,
            effect: 'fade',
            speed: 300,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 2500,
            gap: 20,
            distance: 20,
            type: 'outline',
            position: 'right top'
        });
    }
    
    function RefreshParty(displayinject = true) {
        let myNotify = null;
        if (displayinject) {
            myNotify = new Notify({
                status: "info",
                title: "Grabbing Data!",
                text: "Please wait while we load your party.",
                effect: 'fade',
                speed: 300,
                showIcon: true,
                showCloseButton: true,
                autoclose: false,
                autotimeout: 2500,
                gap: 20,
                distance: 20,
                type: 'outline',
                position: 'right top'
            });
        }

        const authToken = localStorage.getItem('authToken');
        const authenticity = "SAIO: t=eyJlbmNG1HTEJjT0lUZ21rek1Jd01ZeEIwdllYOUdXTGQ0RjN0bWErTkJWZ3lhb3VKMVdXOC85cURUdUhpRWZJcDlrQzlIWXBUVEhnYUpNSENIUys5a3FWZENtcFdmeWJNL0VkN0dLaGxZYnphZ2c9OjqQKzOhgJb94gJamrt2xHod";

        if (authToken) {
            fetch(`../ENAPI/partyinfo.php?token=${authToken}&authenticity=${authenticity}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {

                handleResponse(data);
                if (myNotify) {
                    myNotify.close();
                }
            })
            .catch(() => {
                handleError();
                if (myNotify) {
                    myNotify.close();
                }
            });
        }
    }

    function ActionBtn(action) {
        let myNotify = new Notify({
            status: "info",
            title: "Injecting...",
            text: "Please wait.",
            effect: 'fade',
            speed: 300,
            showIcon: true,
            showCloseButton: true,
            autoclose: false,
            autotimeout: 2500,
            gap: 20,
            distance: 20,
            type: 'outline',
            position: 'right top'
        });

        const authToken = localStorage.getItem('authToken');
        const authenticity = "SAIO: t=eyJlbmNG1HTEJjT0lUZ21rek1Jd01ZeEIwdllYOUdXTGQ0RjN0bWErTkJWZ3lhb3VKMVdXOC85cURUdUhpRWZJcDlrQzlIWXBUVEhnYUpNSENIUys5a3FWZENtcFdmeWJNL0VkN0dLaGxZYnphZ2c9OjqQKzOhgJb94gJamrt2xHod";

        if (authToken) {
            fetch(`../ENAPI/partybutton.php?token=${authToken}&authenticity=${authenticity}&action=${action}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                myNotify.close(); 
                new Notify({
                    status: "success",
                    title: "Success!",
                    text: data.message,
                    effect: 'fade',
                    speed: 300,
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 2500,
                    gap: 20,
                    distance: 20,
                    type: 'outline',
                    position: 'right top'
                });
                RefreshParty(false);
            })
            .catch(() => {
                showError("Error with API!");
                myNotify.close();
            });
        }
    }


    function ShowPanel()
    {
        document.getElementById('panel').style.display = "block";
        document.getElementById('btns').style.display = "none";
        
    }
    function HidePanel()
    {
        document.getElementById('panel').style.display = "none";
        document.getElementById('btns').style.display = "flex";
        
    }
    let searchTimeout;

function Search() {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        let myNotify = new Notify({
            status: "info",
            title: "Searching...",
            text: "Please wait.",
            effect: 'fade',
            speed: 300,
            showIcon: true,
            showCloseButton: true,
            autoclose: false,
            autotimeout: 2500,
            gap: 20,
            distance: 20,
            type: 'outline',
            position: 'right top'
        });

        const authToken = localStorage.getItem('authToken');
        const authenticity = "SAIO: t=eyJlbmNG1HTEJjT0lUZ21rek1Jd01ZeEIwdllYOUdXTGQ0RjN0bWErTkJWZ3lhb3VKMVdXOC85cURUdUhpRWZJcDlrQzlIWXBUVEhnYUpNSENIUys5a3FWZENtcFdmeWJNL0VkN0dLaGxZYnphZ2c9OjqQKzOhgJb94gJamrt2xHod";

        const searchValue = document.getElementById('icon-search').value;
        document.getElementById('icons').innerHTML = "";
        if (authToken) {
            fetch(`../ENAPI/partyicons.php?token=${authToken}&authenticity=${authenticity}&search=${searchValue}`, {
                method: 'GET',
            })
            .then(response => response.text())
            .then(data => {
                myNotify.close(); 
                document.getElementById('icons').innerHTML = data;
            })
            .catch(() => {
                showError("Error with API!");
                myNotify.close();
            });
        }
    }, 2000);
}
function spoofTo(name) {
    const authToken = localStorage.getItem('authToken');
    const authenticity = "SAIO: t=eyJlbmNG1HTEJjT0lUZ21rek1Jd01ZeEIwdllYOUdXTGQ0RjN0bWErTkJWZ3lhb3VKMVdXOC85cURUdUhpRWZJcDlrQzlIWXBUVEhnYUpNSENIUys5a3FWZENtcFdmeWJNL0VkN0dLaGxZYnphZ2c9OjqQKzOhgJb94gJamrt2xHod";
            document.getElementById('icons').innerHTML = "";
            if (authToken) {
                fetch(`../ENAPI/spoof.php?token=${authToken}&authenticity=${authenticity}&spoof=${name}`, {
                    method: 'GET',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        new Notify({
                            status: "success",
                            title: "Success!",
                            text: data.message,
                            effect: 'fade',
                            speed: 300,
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 2500,
                            gap: 20,
                            distance: 20,
                            type: 'outline',
                            position: 'right top'
                        });
                        HidePanel();
                    } else {
                        new Notify({
                            status: "error",
                            title: "Error!",
                            text: data.message,
                            effect: 'fade',
                            speed: 300,
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 2500,
                            gap: 20,
                            distance: 20,
                            type: 'outline',
                            position: 'right top'
                        });
                        HidePanel();
                    }
                })
                .catch(() => {
                    showError("Error with API!");
                });
            }
        }
</script>




</html>
