<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <hr>
        <p class="text-center">Made with <b>CodeIgniter, Bootstrap</b></p>
        <p class="text-center">Page load in <b>{elapsed_time}</b> seconds</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="<?= base_url (JS_PATH . 'validate.js'); ?>"></script>
    <script src="<?= base_url (JS_PATH . 'validate_helper.js'); ?>"></script>

    <script>
        var $my_form = $("#login_form")
        $my_form.validate()
    </script>

    <script>
        var $my_form = $("#student_form")
        $my_form.validate()
    </script>

    <script>
        var $my_form = $("#group_form")
        $my_form.validate()
    </script>

    <script>
        var $my_form = $("#recherche_etudiant_form")
        $my_form.validate()
    </script>

    <script>
        var $my_form = $("#recherche_groupe_form")
        $my_form.validate()
    </script>

</body>
</html>