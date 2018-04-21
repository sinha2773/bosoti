<form name="form" method="post" action="<?php echo base_url($admin_path);?>member/save_member" enctype="multipart/form-data">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter name" class="form-control"  required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Mobile number</label>
                    <input type="text" name="mobile" placeholder="Enter Mobile number" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Password" class="form-control"  required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Re-type Password</label>
                    <input type="password" name="re_password" placeholder="Re-type Password" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Father Name</label>
                    <input type="text" name="fathername" placeholder="Enter your Father Name" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Mother Name</label>
                    <input type="text" name="mothername" placeholder="Enter your Mother Name" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Husband/Wife Name</label>
                    <input type="text" name="spousename" placeholder="Enter your Husband/Wife Name" class="form-control" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="text" name="date_of_birth" placeholder="Enter your Date of Birth" class="form-control dateofbirth" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>National ID Card Number</label>
                    <input type="text" name="nid" placeholder="Enter your National ID Card Number" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option  value="male">Male</option>
                            <option  value="female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Occupation</label>
                    <input type="text" name="occupation" placeholder="Enter your occupation" class="form-control" >
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Educational Qualification</label>
                    <input type="text" name="education" placeholder="Enter your Educational Qualification" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Religion</label>
                    <input type="text" name="religion" placeholder="Enter your Relizon" class="form-control" >
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="nationality" placeholder="Enter your nationality" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php 
                    $member_id = $this->member_model->getMemberNewId();
                    ?>
                    <label>Member ID</label>
                    <input type="text" name="client_id" value="<?php echo $member_id;?>" placeholder="Enter your member No" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Admission Date</label>
                    <input type="text" id="admission_date" name="admission_date" placeholder="Enter your Admission Date" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Blood Group</label>
                    <input type="text" name="blood_group" placeholder="Enter your Blood Group" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Permanent Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="village" placeholder="Enter your Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="post_office" placeholder="Enter your Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="police_station" placeholder="Enter your Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="district" placeholder="Enter your District" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Present Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="p_village" placeholder="Enter your Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="p_post_office" placeholder="Enter your Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="p_police_station" placeholder="Enter your Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="p_district" placeholder="Enter your District" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Nominee Identity</h3>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="n_name" placeholder="Enter Name" class="form-control" >
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Father Name</label>
                    <input type="text" name="n_fathername" placeholder="Enter Father Name" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Mother Name</label>
                    <input type="text" name="n_mothername" placeholder="Enter Mother Name" class="form-control" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="text" name="n_date_of_birth" placeholder="Enter Date of Birth" class="form-control nominee_dateofbirth" >
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label>National ID Card Number</label>
                    <input type="text" name="n_nid" placeholder="Enter National ID Card Number" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Permanent Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="n_village" placeholder="Enter Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="n_post_office" placeholder="Enter Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="n_police_station" placeholder="Enter Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="n_district" placeholder="Enter District" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Present Address</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Village</label>
                    <input type="text" name="np_village" placeholder="Enter Village" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Post Office</label>
                    <input type="text" name="np_post_office" placeholder="Enter Post office" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Police station</label>
                    <input type="text" name="np_police_station" placeholder="Enter Police station" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District</label>
                    <input type="text" name="np_district" placeholder="Enter District" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <h3>Nominee relationship</h3>
                <input type="text" name="nominee_relationship" placeholder="Enter Nominee relationship" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <input checked="true" type="radio" name="status" value="1"> Enable  
            <input type="radio" name="status" value="0">  Disable
        </div>
        <div class="form-group">
            <input  checked="true" type="radio" name="membership_type" value="1"> New Member  
            <input type="radio" name="membership_type" value="2">  Reference
        </div>
        <div class="form-group" id="ref_member_id" style="display: none">
            <label >Select Member <sup><i class="fa fa-star" style="color: red; font-size: 8px"></i></sup>
            </label>
            <input type="text" autocomplete="off" name="member_name" placeholder="Select Member" id="member_select" class="form-control">
            <span class="help-block" id="member_help_block" ></span>
            <input type="hidden" autocomplete="off" name="ref_mem_id"  class="form-control">
            <table class="table table-condensed table-hover table-bordered clickable" id="member_select_result" style="position: absolute;z-index: 10;background-color: #fff;width: 92%">
            </table>
        </div>

    </div>
    <div id="widget-grid" class="col-sm-3">       

        <div class="section">
            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Member Image</h2>
                </header>
                <div class="widget-body section_content">
                    <p>
                        <input type="file" class="file_upload1" name="image" accept="image/*" onchange="read_image(event, this.value)"/>
                        <?php $atts = array('width'=> '880','height'=> '450','scrollbars' => 'yes','status' => 'no','resizable' => 'yes','screenx' => '50','screeny' => '10');?>
                    </p>
                    <p>
                        <input type="hidden" name="media_id" id="media_id" value="">
                        <img id="reader_image"  height="100"/>
                    </p>
                </div>
            </div>

        </div>

    </div>



    <div id="widget-grid" class="col-sm-3">       

        <div class="section">
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Nominee Image</h2>
                </header>
                <div class="widget-body section_content">
                    <p>
                        <input type="file" class="file_upload" name="image2" accept="image/*" onchange="read_image(event, this.value, 'reader_image2')"/>
                        <?php $atts = array('width'=> '880','height'=> '450','scrollbars' => 'yes','status' => 'no','resizable' => 'yes','screenx' => '50','screeny' => '10');?>
                    </p>
                    <p>
                        <input type="hidden" name="media_id2" id="media_id2" value="">
                        <img id="reader_image2" height="100"/>
                    </p>
                </div>
            </div>

        </div>

    </div>

    <div id="widget-grid" class="col-sm-3">       

        <div class="section">
            <div class="jarviswidget" id="wid-id-5" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Attachments Files</h2>
                </header>
                <div class="widget-body section_content">
                    <div id="UploadFileContainer">
                      <input class="form-control" type="file" name="files[]">
                    </div>
                    <div class="">                               
                        <button onclick="addFileContainer('UploadFileContainer')" type="button" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span>Add files</span>
                        </button>                                
                    </div>
                </div>
            </div>

        </div>

    </div>


    <div class="form-group text-center" style="float: left; width: 100%;">
        <a href="<?php echo base_url($admin_path);?>/common/get_all/<?php echo $action;?>"><input type="button" class="btn btn-danger btn-lg" value="Cancel"></a>
        <input type="submit" class="btn btn-primary btn-lg" value="Save">
    </div>

</form>
<script type="text/javascript">
    var timer;
    $("#member_select").keyup(function(event) 
    {
        $("#memberacc_select_result").show();
        $("#memberacc_select_result").html('');
        clearTimeout(timer);
        timer = setTimeout(function() 
        {
            var search_member = $("#member_select").val();
            var html = '';
            $.post('<?php echo site_url(); ?>admin/Payment/search_member_by_name',{q: search_member}, function(data, textStatus, xhr) {
                data = JSON.parse(data);
                $.each(data, function(index, val) {
                    html+= '<tr><td data="'+val.id+'">'+val.client_id+'</td></tr>';
                });
                $("#member_select_result").html(html);
            });
        }, 500);
    });
    $("#member_select_result").on('click', 'td', function(event) {
        $('input[name="member_name"]').val($(this).text());
        $('input[name="ref_mem_id"]').val($(this).attr('data'));
        $("#member_select_result").hide();
    });

    jQuery(document).ready(function(){
        $('#admission_date, .dateofbirth, .nominee_dateofbirth').datepicker({
            dateFormat: 'yy-mm-dd', 
            changeMonth: true,
            changeYear: true,
        });
    });

    $('input:radio[name="membership_type"]').change(
        function(){
            if(this.value == "2"){
                $('#ref_member_id').show();
            }
            else{
              $('#ref_member_id').hide();
          }
      });
  </script>


