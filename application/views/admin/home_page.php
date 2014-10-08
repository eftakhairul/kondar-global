<script type="text/javascript">

    function confirm_box(){

        var answer = confirm ("Are you sure?");

        if (!answer)

        return false;

}



</script>

<style>

    .selector{

        width:150px !important;

        padding:3px 13px !important;

    }

</style>



<!-- Main content -->

<div style="margin-right: 0px;" class="content">

    <?php
    if ($this->session->flashdata('success')) {

        $msg = $this->session->flashdata('success');
        ?>

        <div class="notice outer">

            <div class="note"><?php echo $msg; ?>

            </div>

        </div>

    <?php
}
?>    

    <?php
    if ($this->session->flashdata('error')) {

        $msg = $this->session->flashdata('error');
        ?>

        <div class="notice outer">

            <div class="error"><?php echo $msg; ?>

            </div>

        </div>

    <?php
}
?>    







    <div class="outer">

        <div class="inner">

            <div class="page-header">

                <!-- page title -->

                <h5><i class="font-user"></i><?php echo $name; ?> Setting</h5>

                <!-- End page title -->

                <div class="body">





                    <!-- Content container -->

                    <div class="container">

                        <!-- Default datatable -->

                        <div class="block well" style="margin-top:30px">

                            <div class="navbar">

                                <div class="navbar-inner">

                                    <h5><?php echo $this->lang->line('') . 'List'; ?></h5>



                                </div>

                            </div>

                            <div class="table-overflow">

                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">

                                    <div class="datatable-header" style="padding:10px">

<?php
if ($name == 'Welcome Page') {
    ?>

                                            <a href="admin/index/welcome_page"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Welcome Page'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/globe_product"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Globe Product'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>

    <?php
} else if ($name == 'Home Page') {
    ?>

                                            <a href="admin/index/library_page"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'E-Library Background'; ?></div>

                                            </a>



                                            <div style="clear:both;padding:5px"></div>

                                            <a href="admin/index/library_product"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'E-Library Product'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/slider"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Slider'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>


                                            <a href="admin/settings/index"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Global Settings'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



    <?php
} else if ($name == 'Promotion') {
    ?>

                                            <a href="admin/index/promotion_section"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Promotion'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <?php /* ?><a href="admin/index/promotion_category"style="float:left;margin-right:10px;"  >

                                              <div id="" class="selector" ><?php echo $this->lang->line('').'Category';?></div>

                                              </a>

                                              <div style="clear:both;padding:5px"></div><?php */ ?>



                                            <a href="admin/index/promotion_user"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Download Request User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/knowledge_subtitle"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Knowledge Center SubTitle'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/promotion_block_user"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Block User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



    <?php
} else if ($name == 'product') {
    ?>

                                            <a href="admin/index/vehicles_part" style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Product Type'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/brand" style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Brand'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/model" style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Model'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/product" style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Products'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/incoterm" style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Incoterms'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



    <?php
} else if ($name == 'Order') {
    ?>

                                            <a href="admin/index/order_list" style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Order History'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/order_user" style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Order User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>





                                            <?php
                                        } else if ($name == 'interview') {
                                            ?>

                                            <a href="admin/career/job_section" style="float:left;margin-right:10px;" >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Job section'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>

                                            <a href="admin/career/interview_section"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/career/user_block"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Block User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <?php
                                        } else if ($name == 'distribution') {
                                            ?>

                                            
                                            <div style="clear:both;padding:5px"></div>

                                            <a href="admin/distribution/user_list"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/distribution/distribution_blocks_list"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Block User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>

                                            <?php
                                        } else if ($name == 'contact') {
                                            ?>



                                            <a href="admin/index/contact_user"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



                                            <a href="admin/index/contact_user_block"style="float:left;margin-right:10px;"  >

                                                <div id="" class="selector" ><?php echo $this->lang->line('') . 'Block User List'; ?></div>

                                            </a>

                                            <div style="clear:both;padding:5px"></div>



    <?php
}
?>



                                        <!--									<div style="clear:both;padding:5px"></div>
                                        
                                                                            <a href="" style="float:left;margin-right:10px;">
                                        
                                                                            <div id="" class="selector" >subscribed predictions
                                        
                                                                            </div></a>-->

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- /default datatable -->





                        <!-- Pickers -->

                    </div>



                    <!-- /pickers -->



                </div>



            </div>

        </div>

    </div>

    <!-- /content -->



    <!-- Right sidebar -->



    <!-- /right sidebar -->    

</div>

<!-- /main wrapper -->