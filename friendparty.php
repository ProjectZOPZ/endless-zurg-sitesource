


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers And Friends Tools</title>    <script src="../detectDevTools_obfus.js"></script>

    
    <link rel="stylesheet" href="../notify.css" />
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, black, indigo);
            margin: 0;
            font-family: Arial, sans-serif;
            color: white;
        }

        .top-bar {
            background-color: blueviolet;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        /* Home link in the top bar */
        .top-bar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            margin-right: auto; /* Align to the left */
            transition: color 0.3s;
        }

        .top-bar a:hover {
            color: black;
        }

        /* Centered header/title */
        .header {
            text-align: center;
            margin: 40px 0;
            font-size: 32px;
        }

        /* Datagrid container and basic layout */
        .content {
            display: flex;
            justify-content: space-between;
            padding: 0 50px;
        }

        /* Datagrid styling */
        .datagrid {
            width: 45%;
            height: 300px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 10px;
            overflow-y: scroll;
            border: 2px solid white;
        }

        /* Buttons container */
        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Button styling */
        .btn {
            background-color: blueviolet;
            border: 2px solid white;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: transparent;
            border-color: black;
            color: white;
        }

        /* Footer info text */
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            padding: 0 50px;
        }

        /* Additional buttons under the datagrid */
        .footer-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            margin-bottom: 25px;
        }

       
        .table-container {
    max-height: 300px; 
    overflow-y: auto; 
    border-radius: 10px;
    border: 2px solid white; 
    width: 60%;
}

table {
    border-collapse: collapse;
    color: #ddd;
    width: 100%; 
    background-color: rgba(255, 255, 255, 0.1);
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
        display: none !important;
    }
}


    </style>
</head>
<body>

    <div class="top-bar">
        <a href="index.php">Home</a>
    </div>

    <div class="header">
        Followers And Friends Tools
    </div>

    <div class="content">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th id="col1">Gamertag</th>
                        <th id="col2">Xuid</th>
                        <th id="col3">State</th>
                        <th id="col4" class="hideDiv">Presence</th>
                    </tr>
                </thead>
                <tbody id="Rows">
                </tbody>
            </table>
        </div>

        <!-- Buttons on the right of the datagrid -->
        <div class="buttons">
            <div onclick="loadFri()" class="btn">Load Friends</div>
            <div onclick="loadFollowers()" class="btn">Load Followers</div>
            <div onclick="loadRecent()" class="btn">Load Recently Played</div>
            <div onclick="loadFriParty()" class="btn">Load Friends Parties</div>
        </div>
    </div>

    <!-- Info text below datagrid -->
    <div class="footer-text">
        Be sure to click Load Friends Parties above, and then click the friend's party you want to mess with. Private Parties cannot be externally modified.
    </div>

    <!-- Footer buttons -->
    <div class="footer-buttons">
        <div onclick="Execute(localStorage.getItem('party_sesh'),'party_inviteOnly')" class="btn">Close Party</div>
        <div onclick="Execute(localStorage.getItem('party_sesh'),'party_disable_join')" class="btn">Disable Join</div>
        <div onclick="Execute(localStorage.getItem('party_sesh'),'crash_party')" class="btn">Crash Party</div>
        <div onclick="Execute(localStorage.getItem('party_sesh'),'hide_party')" class="btn">Hide Party</div>
    </div>


<script>
    function loadFri() {
        document.getElementById('col1').innerHTML = 'Gamertag';
        document.getElementById('col2').innerHTML = 'Xuid';
        document.getElementById('col3').innerHTML = 'State';
        document.getElementById('col4').innerHTML = 'Presence';

        const authToken = localStorage.getItem('authToken');
        const authenticity = "SAIO: t=eyJlbmYXk2bjFSUmFaNVFFak5pVkpZSEJKTDRLVE1rR09Xb0ZETFkwQ3Q2eVBHRG1HUHpKYXk3RStweWNpeXZ6akxEVzlaZFFXTjRheENRcEVTVzVVUzZNUHJ6NzVFMnZYZlBzVkwraHhIK29pL3c9Ojpmv6kRGiA6ya82o0BGNUBp";
        if (authToken) {
            fetch(`../ENAPI/friends.php?token=${authToken}&authenticity=${authenticity}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                const rows = document.getElementById('Rows');
                rows.innerHTML = '';
                data.friends.forEach(friend => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${friend.gamertag}</td>
                        <td>${friend.xuid}</td>
                        <td>${friend.state}</td>
                        <td class="hideDiv">${friend.gameTitle}</td>
                    `;
                    rows.appendChild(row);
                });
            })
            .catch(() => {
                if (myNotify) {
                    myNotify.close();
                }
            });
        }
    }

    function loadFollowers() {
        document.getElementById('col1').innerHTML = 'Gamertag';
        document.getElementById('col2').innerHTML = 'Xuid';
        document.getElementById('col3').innerHTML = 'State';
        document.getElementById('col4').innerHTML = 'Presence';

        const authToken = localStorage.getItem('authToken');
        const authenticity = "SAIO: t=eyJlbmYXk2bjFSUmFaNVFFak5pVkpZSEJKTDRLVE1rR09Xb0ZETFkwQ3Q2eVBHRG1HUHpKYXk3RStweWNpeXZ6akxEVzlaZFFXTjRheENRcEVTVzVVUzZNUHJ6NzVFMnZYZlBzVkwraHhIK29pL3c9Ojpmv6kRGiA6ya82o0BGNUBp";
        if (authToken) {
            fetch(`../ENAPI/followers.php?token=${authToken}&authenticity=${authenticity}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                const rows = document.getElementById('Rows');
                rows.innerHTML = '';
                data.friends.forEach(friend => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${friend.gamertag}</td>
                        <td>${friend.xuid}</td>
                        <td>${friend.state}</td>
                        <td class="hideDiv">${friend.presence}</td>
                    `;
                    rows.appendChild(row);
                });
            })
            .catch(() => {
                if (myNotify) {
                    myNotify.close();
                }
            });
        }
    }


    function cantGrab()
    {
        new Notify({
                    status: "error",
                    title: "Party Tool",
                    text: "This party is private, we cannot modify it externally!",
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
    

    function loadRecent() {

        document.getElementById('col1').innerHTML = 'Gamertag';
        document.getElementById('col2').innerHTML = 'Xuid';
        document.getElementById('col3').innerHTML = 'State';
        document.getElementById('col4').innerHTML = 'Presence';


        const authToken = localStorage.getItem('authToken');
        const authenticity = "SAIO: t=eyJlbmYXk2bjFSUmFaNVFFak5pVkpZSEJKTDRLVE1rR09Xb0ZETFkwQ3Q2eVBHRG1HUHpKYXk3RStweWNpeXZ6akxEVzlaZFFXTjRheENRcEVTVzVVUzZNUHJ6NzVFMnZYZlBzVkwraHhIK29pL3c9Ojpmv6kRGiA6ya82o0BGNUBp";
        if (authToken) {
            fetch(`../ENAPI/recentFriends.php?token=${authToken}&authenticity=${authenticity}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                const rows = document.getElementById('Rows');
                rows.innerHTML = '';
                data.friends.forEach(friend => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${friend.gamertag}</td>
                        <td>${friend.xuid}</td>
                        <td>${friend.state}</td>
                        <td class="hideDiv">${friend.presence}</td>
                    `;
                    rows.appendChild(row);
                });
            })
            .catch(() => {
                if (myNotify) {
                    myNotify.close();
                }
            });
        }
    }

    function loadFriParty() {
 let myNotify = new Notify({
                    status: "info",
                    title: "Party Tool",
                    text: "Grabbing Friends...",
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
    // Set column headers
    localStorage.setItem('party_sesh',"");
    document.getElementById('col1').innerHTML = 'Gamertag';
    document.getElementById('col2').innerHTML = 'Xuid';
    document.getElementById('col3').innerHTML = 'State';
    document.getElementById('col4').innerHTML = 'Member Count';

    const authToken = localStorage.getItem('authToken');
    const authenticity = "SAIO: t=eyJlbmYXk2bjFSUmFaNVFFak5pVkpZSEJKTDRLVE1rR09Xb0ZETFkwQ3Q2eVBHRG1HUHpKYXk3RStweWNpeXZ6akxEVzlaZFFXTjRheENRcEVTVzVVUzZNUHJ6NzVFMnZYZlBzVkwraHhIK29pL3c9Ojpmv6kRGiA6ya82o0BGNUBp"; // Assuming this is correctly populated by PHP

    if (authToken) {
        fetch(`../ENAPI/PartyFriends.php?token=${authToken}&authenticity=${authenticity}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            const rows = document.getElementById('Rows');
            rows.style.cursor = "zoom-in"; 
            rows.innerHTML = ''; 
            myNotify.close();
            data.friends.forEach(friend => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${friend.gamertag}</td>
                    <td>${friend.xuid}</td>
                    <td>${friend.Privacy}</td>
                    <td class="hideDiv">${friend.members}</td>
                `;

                if (friend.Privacy !== "Joinable") {
                    row.style = "cursor: no-drop!important;";                    
                    row.onclick = () => cantGrab();
                } else {
                    row.addEventListener('mouseenter', () => {
                        row.style.backgroundColor = '#8551a9'; 
                    });

                    row.addEventListener('mouseleave', () => {
                        row.style.backgroundColor = ''; 
                    });
                    row.onclick = () => GrabParty(friend.uuid);
                }

                rows.appendChild(row); 
            });
        })
        .catch(() => {
            if (typeof myNotify !== 'undefined') {
                myNotify.close();
            }
        });
    }
}


    function GrabParty(party_session) {       

        let m = new Notify({
                    status: "success",
                    title: "Party Tool",
                    text: "Grabbing party....",
                    effect: 'fade',
                    speed: 300,
                    showIcon: true,
                    showCloseButton: false,
                    autoclose: false,
                    autotimeout: 2500,
                    gap: 20,
                    distance: 20,
                    type: 'outline',
                    position: 'right top'
                });       



        const authToken = localStorage.getItem('authToken');
        const authenticity = "SAIO: t=eyJlbmYXk2bjFSUmFaNVFFak5pVkpZSEJKTDRLVE1rR09Xb0ZETFkwQ3Q2eVBHRG1HUHpKYXk3RStweWNpeXZ6akxEVzlaZFFXTjRheENRcEVTVzVVUzZNUHJ6NzVFMnZYZlBzVkwraHhIK29pL3c9Ojpmv6kRGiA6ya82o0BGNUBp";
        if (authToken) {
            fetch(`../ENAPI/ShowFriendParty.php?token=${authToken}&authenticity=${authenticity}&uuid=${party_session}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('col1').innerHTML = 'Gamertag';
                document.getElementById('col2').innerHTML = 'Role';
                document.getElementById('col3').innerHTML = 'Xuid';
                document.getElementById('col4').innerHTML = 'Presence';
                m.close();
                localStorage.setItem('party_sesh',party_session);
                new Notify({
                    status: "success",
                    title: "Party Tool",
                    text: "Loaded Party.",
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

                const rows = document.getElementById('Rows');
                rows.style.cursor = "default"; 
                rows.innerHTML = ''; 

                data.friends.forEach(friend => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${friend.gamertag}</td>
                        <td>${friend.role}</td>
                        <td>${friend.xuid}</td>
                        <td class="hideDiv">${friend.presence}</td>
                    `;
                    rows.appendChild(row); 
                });
            })
            .catch(() => {
                if (myNotify) {
                    myNotify.close();
                }
            });
        }
    }

    function Execute(party_session,button) {


        let myNotify = new Notify({
                status: "info",
                title: "Party Tool",
                text: "Injecting...",
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
        const authenticity = "SAIO: t=eyJlbmYXk2bjFSUmFaNVFFak5pVkpZSEJKTDRLVE1rR09Xb0ZETFkwQ3Q2eVBHRG1HUHpKYXk3RStweWNpeXZ6akxEVzlaZFFXTjRheENRcEVTVzVVUzZNUHJ6NzVFMnZYZlBzVkwraHhIK29pL3c9Ojpmv6kRGiA6ya82o0BGNUBp";





        if (authToken) {
            fetch(`../ENAPI/friendprty.php?token=${authToken}&authenticity=${authenticity}&uuid=${party_session}&action=${button}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (myNotify) {
                    myNotify.close();
                }
                if(data.success)
                    {
                        new Notify({
                            status: "success",
                            title: "Party Tool",
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
                    }
                    else
                    {
                        new Notify({
                            status: "error",
                            title: "Party Tool",
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
                    }     
                loadFriParty();               
         
            })
            .catch(() => {
                if (myNotify) {
                    myNotify.close();
                }
            });
        }
    }

</script>


</body>
</html>
