<!Doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link rel="icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon">
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-migrate-1.2.1.min.js"></script>
        <?php foreach ($css_src as $css) : ?>
            <link rel="stylesheet" href="<?php echo $css ?>" type="text/css" media="screen"/>
        <?php endforeach; ?>
    
        <script type="text/javascript">
            base_url = '<?php echo base_url(); ?>';
            
            /** show date time on header **/
            $(function(){
                $.ajaxSetup({
                    async:false
                })
                $.ajax({
                    type: "POST",
                    url: base_url+"front/get_current_time",
                    success: function(msg){
                        startTime(msg); 
                    }
                });
                $.ajaxSetup({
                    async:true
                })
            });      
        </script>
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/master/css/welcome.css'); ?>" media="screen">
    </head>
