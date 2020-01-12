<?php
require "header.php";
ob_start();
?>
<main>


    <div class="container">

        <?php
        if (!isset($_SESSION["userID"])) {
            ?>
            <div class="text">

                <h1>Welcome, citizen of the Empire</h1>
                <p>Please consider joining our army</p>

                <div class="disclaimer">
                    <p>Particle effects on this website were created by open source javascript particle library <a
                                href="https://github.com/VincentGarreau/particles.js/">ParticlesJS</a> and bootstrap
                        <a href="https://getbootstrap.com/docs/3.4/getting-started/">Bootsrap</a> with further
                        modifications by me</p>
                </div>
            </div>

            <?php


        }
        ?>

        <?php
        if (isset($_SESSION["userID"]) && $_SESSION["username"] != "admin") {
            ?>
            <div class="text">
                <h1>Welcome <?php echo $_SESSION["username"] ?>, soldier of the empire</h1>
                <p>We are glad that you pledged your alliance to the First Galactic Empire
                    For now on, you are expected to hone your battle skills in training courses
                    provided by your Emperor, long live the Emperor
                </p>

                <div class="disclaimer">
                    <p>Particle effects on this website were created by open source javascript particle library <a
                                href="https://github.com/VincentGarreau/particles.js/">ParticlesJS</a> and bootstrap
                        <a href="https://getbootstrap.com/docs/3.4/getting-started/">Bootsrap</a> with further
                        modifications by me</p>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        if (isset($_SESSION["userID"]) && $_SESSION["username"] == "admin") {

            ?>
            <div class="text">
                <h1>Welcome Emperor</h1>
                <p>We are honored by your visit, of course, being you, an Emperor you have right to oversee your troops
                    and execute them on a whim,
                    you can even add new courses or delete obsolete ones.
                    Long live the Emperor
                </p>

                <div class="disclaimer">
                    <p>Particle effects on this website were created by open source javascript particle library <a
                                href="https://github.com/VincentGarreau/particles.js/">ParticlesJS</a> and bootstrap
                        <a href="https://getbootstrap.com/docs/3.4/getting-started/">Bootsrap</a> with further
                        modifications by me</p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

</main>

<?php
ob_end_flush();
require "footer.php";
?>
