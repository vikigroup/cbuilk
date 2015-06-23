<script type="text/javascript" src="scripts/up/jquery.form.js"></script>
                    
                    
                    <script type="text/javascript" >
                     $(document).ready(function() { 
                            
                                $('#photoimg').live('change', function()			{ 
                                           $("#preview").html('');
                                    $("#current").hide();
                                    $("#preview").html('<img src="scripts/up/ajax-loader.gif" alt="Uploading...."/>');
                                $("#imageform").ajaxForm({
                                            target: '#preview'
                            }).submit();
                            
                                });
                            }); 
                    </script>
                    
                    <style>
                    
                    body
                    {
                    font-family:arial;
                    }
                    .preview
                    {
                    max-width:200px;
                    max-height:200px;
                    border:solid 1px #dedede;
                    padding:5px;
                    }
                    #preview
                    {
                    color:#cc0000;
                    font-size:12px
                    }
                    
                    </style>
                  Nội dung <br />
                  Up hình nhanh: <br />
                  <form id="imageform" method="post" enctype="multipart/form-data" action='ajax_file.php'>
                <b>Upload image from your computer:</b> <input type="file" name="photoimg" id="photoimg" /><br><br/>
                <div class="color_small">Maximum size of 1024k. JPG, GIF, PNG.</div>
                
                </form>
                <div id='preview'></div>