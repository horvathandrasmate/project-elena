<?php
function alert_swal_error($message, $redirect_url = "")
{

    echo "
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.all.min.js\"></script>
<script>
            
            $(document).ready(function(){
                Swal.fire({
                 title: 'Error!',
                text: '$message',
                 type: 'error',
                 confirmButtonText: 'OK' 
                }).then(function(){
                    if('".$redirect_url."' !== ''){
                        window.location.href = '" . base_url($redirect_url) . "';
                    }
                });
            });
        </script>";

}
function alert_swal_success($message, $redirect_url = "")
{

    echo "
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.all.min.js\"></script>
<script>
            
            $(document).ready(function(){
                Swal.fire({
                 title: 'Success!',
                text: '$message',
                 type: 'success',
                 confirmButtonText: 'OK' 
                }).then(function(){
                    if('".$redirect_url."' !== ''){
                        window.location.href = '" . base_url($redirect_url) . "';
                    }
                });
            });
        </script>";

}