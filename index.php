<?php include "./includes/global.php";
session_start();
?>

<!DOCTYPE html>
<html>


<?php include "./layouts/head.php"?>

<body>

    <?php include "./layouts/header.php"?>

    <div><img style="height:750px;width:100%;margin-top: -20px;"
            src="<?php echo ROOT ?>/assets/images/Roll-Alignment-Printing-press-web-res-copy.jpg"></div>
    <div style="text-align:center;margin-top: -500px; color: #fff;">
        <h3>Welcome To</h3><br>
        <h1 style="font-weight: bold;font-size:65px;font-family:Arial;">PRINT LOGIC.CO</h1>
    </div>
    <div class="container">
        <div class="fd-section col-md-12" style="margin-top:150px;">
            <center>
                <div>
                </div>
                <h1 style="font-family:calibri;">PRINTING PRESS MACHINES</h1>
                <div class="underline"></div>
            </center><br><br><br><br>

        </div>
    </div>

    <div class="team-section-e">
        <div class="team">
            <div class="card-e">
                <div>
                    <img src="<?php echo ROOT ?>/assets/images/single-color-used-offset-printing-machine-500x500.jpg"
                        alt="" />
                </div>
                <p class="profile-name-e">TWO COLOR OFFSET PRINTING PRESS</p>
            </div>
            <div class="card-e">
                <div class="image">
                    <img src="<?php echo ROOT ?>/assets/images/HEIDELBERG GTO OFFSET GTO 46 ZP 1979  (2).jpg" alt="" />
                </div>
                <p class="profile-name-e">HEIDELBERG GTO 46 ZP OFFSET</p>
            </div>
            <div class="card-e">
                <div class="image">
                    <img src="<?php echo ROOT ?>/assets/images/Ryobi_3302H_Two_Color_Offset_Printing_Press_050219052941-3.jpg"
                        alt="" />
                </div>
                <p class="profile-name-e">Ryobi 3302H<br>Two color printing press</p>
            </div>
            <div class="card-e">
                <div class="image">
                    <img style="height:250px;" src="<?php echo ROOT ?>/assets/images/53.jpg" alt="" />
                </div>
                <p class="profile-name-e">Detroit, MI<br>A-1 Enterprises Printing Equipment Auction</p>
            </div>
        </div>
    </div>


    <div class="team-section" style="background-color: #eee;">
        <p class="heading">OUR TEAM</p>
        <center>
            <div class="underline" style="width: 150px;"></div>
        </center><br><br><br><br>
        <div class="team">
            <div class="card">
                <div class="card1">
                    <div class="image">
                        <img src="<?php echo ROOT ?>/assets/images/hamza.jpeg" alt="" />
                    </div>
                    <p class="profile-name">Hamza</p>
                    <p class="occupation">Developer</p>
                </div>
            </div>
            <div class="card">
                <div class="card1">
                    <div class="image">
                        <img src="<?php echo ROOT ?>/assets/images/zeeshan.jpeg" alt="" />
                    </div>
                    <p class="profile-name">Zeeshan</p>
                    <p class="occupation">Team Lead</p>
                </div>
            </div>
            <div class="card">
                <div class="card1">
                    <div class="image">
                        <img src="<?php echo ROOT ?>/assets/images/irfan.jpeg" alt="" />
                    </div>
                    <p class="profile-name">Irfan</p>
                    <p class="occupation">Database Engineer</p>
                </div>
            </div>
        </div>
    </div>



    <!-- footer -->

    <?php include "./layouts/footer.php"?>
    <?php include "./layouts/scripts.php"?>

    <style type="text/css">
    .team-section-e {
        width: 100%;
        padding: 70px 0;
    }

    .card-e {
        width: 300px;
        height: 400px;
        display: flex;
        margin-bottom: 10px;
        flex-direction: column;
        align-items: center;
        border: 1px solid grey;
        box-shadow: 5px 5px 30px 5px #0004;
    }

    .profile-name-e {
        font-size: 20px;
        font-weight: bold;
        font-family: calibri;
        padding: 0 10px 0 10px;
        margin-top: 20px;
        text-align: center;
    }

    .card-e img {
        width: 100%;
    }

    #sources-form {
        width: 50%;
        background-color: #eee;
        padding: 10px 30px 40px 30px;
        line-height: 40px;
        margin-top: 140px;
        box-shadow: 5px 5px 30px 5px #0004;
    }

    #reg-form {
        width: 40%;
        background-color: #eee;
        padding: 10px 30px 40px 30px;
        line-height: 40px;
        box-shadow: 5px 5px 30px 5px #0004;
        margin-top: 180px;
    }

    .sh-btn {
        background: none;
        color: #fff;
        margin-top: 15px;
        border: none;
    }

    .register-info {
        background: #b5b5b5;
        color: #fff;
        padding: 0px 15px;
        font-weight: 400;
        margin: 15px 0 25px 0;
    }

    .reg-input {
        border: 1px solid #43bbec;
        margin-bottom: 20px;
    }

    .sf-input {
        border: 1px solid #43bbec;
        width: 100%;
        height: 35px;
        border-radius: 4px;
    }

    @media (max-width: 767px) {
        #sources-form {
            width: 60%;
            margin-top: 80px;
        }

        .s-btn {
            width: 35%;
        }

        #reg-form {
            width: 60%;
            margin-top: 80px;
        }

        #reg-form h2 {
            font-size: 25px;
        }
    }
    </style>

</body>

</html>