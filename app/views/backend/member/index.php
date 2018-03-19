<div class="col-sm-12 col-md-8 col-md-offset-2" style="background: #fff; padding-top: 10px;">

    <table class="table">
        <tr>
            <td>
                <?php $media = $this->master->get_image($data->media_id,"member"); ?>
                <img id="reader_image" src="<?php echo $media->src;?>" width="100" height="100"/>
            </td>
            <td>
                <table class="table">
                    <tr>
                        <td>Member ID:</td>
                        <td><?php echo $data->client_id;?></td>
                    </tr> 
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $data->name;?></td>
                    </tr> 
                    <tr>
                        <td>Mobile:</td>
                        <td><?php echo $data->mobile;?></td>
                    </tr>   
                    <tr>
                        <td>Father name:</td>
                        <td><?php echo $data->fathername;?></td>
                    </tr> 
                    <tr>
                        <td>Mother name:</td>
                        <td><?php echo $data->mothername;?></td>
                    </tr> 
                    <tr>
                        <td>Husband/Wife name:</td>
                        <td><?php echo $data->spousename;?></td>
                    </tr> 
                    <tr>
                        <td>Date of Birth:</td>
                        <td><?php echo $data->date_of_birth;?></td>
                    </tr> 
                    <tr>
                        <td>National ID Card Number:</td>
                        <td><?php echo $data->nid;?></td>
                    </tr> 
                    <tr>
                        <td>Occupation:</td>
                        <td><?php echo $data->occupation;?></td>
                    </tr>
                    <tr>
                        <td>Educational Qualification:</td>
                        <td><?php echo $data->education;?></td>
                    </tr>
                    <tr>
                        <td>Religion:</td>
                        <td><?php echo $data->religion;?></td>
                    </tr>
                    <tr>
                        <td>Nationality:</td>
                        <td><?php echo $data->nationality;?></td>
                    </tr>
                    <tr>
                        <td>Blood Group:</td>
                        <td><?php echo $data->blood_group;?></td>
                    </tr>
                    <tr>
                        <td>Admission Date:</td>
                        <td><?php echo $data->admission_date;?></td>
                    </tr>                
                </table>
            </td>
        </tr>
    </table>
    

    <h3>Permanent Address: </h3>
    <table class="table">
        <tr>
            <td>Village:</td>
            <td><?php echo $data->village;?></td>
            <td>Post Office:</td>
            <td><?php echo $data->post_office;?></td>
        </tr>
        <tr>
            <td>Police station:</td>
            <td><?php echo $data->police_station;?></td>
            <td>District:</td>
            <td><?php echo $data->district;?></td>
        </tr>
    </table>

    <h3>Present Address: </h3>
    <table class="table">
        <tr>
            <td>Village:</td>
            <td><?php echo $data->p_village;?></td>
            <td>Post Office:</td>
            <td><?php echo $data->p_post_office;?></td>
        </tr>
        <tr>
            <td>Police station:</td>
            <td><?php echo $data->p_police_station;?></td>
            <td>District:</td>
            <td><?php echo $data->p_district;?></td>
        </tr>
    </table>


    <hr>
    <div class="nominee_section" style="margin-top: 20px;">
        <h3>Nominee identity:</h3>
        <table class="table">
            <tr>
                <td>
                    <?php $media = $this->master->get_image($data->media_id2,"member"); ?>
                    <img id="reader_image" src="<?php echo $media->src;?>" width="100" height="100"/>
                </td>
                <td>
                    <table class="table">
                         
                        <tr>
                            <td>Name:</td>
                            <td><?php echo $data->n_name;?></td>
                        </tr>  
                        <tr>
                            <td>Father name:</td>
                            <td><?php echo $data->n_fathername;?></td>
                        </tr> 
                        <tr>
                            <td>Mother name:</td>
                            <td><?php echo $data->n_mothername;?></td>
                        </tr> 
                        <tr>
                            <td>Date of Birth:</td>
                            <td><?php echo $data->n_date_of_birth;?></td>
                        </tr> 
                        <tr>
                            <td>National ID Card Number:</td>
                            <td><?php echo $data->n_nid;?></td>
                        </tr> 
                        <tr>
                            <td>Nominee relationship:</td>
                            <td><?php echo $data->nominee_relationship;?></td>
                        </tr>            
                    </table>
                </td>
            </tr>
        </table>

        <h3>Permanent Address: </h3>
        <table class="table">
            <tr>
                <td>Village:</td>
                <td><?php echo $data->n_village;?></td>
                <td>Post Office:</td>
                <td><?php echo $data->n_post_office;?></td>
            </tr>
            <tr>
                <td>Police station:</td>
                <td><?php echo $data->n_police_station;?></td>
                <td>District:</td>
                <td><?php echo $data->n_district;?></td>
            </tr>
        </table>

        <h3>Present Address: </h3>
        <table class="table">
            <tr>
                <td>Village:</td>
                <td><?php echo $data->np_village;?></td>
                <td>Post Office:</td>
                <td><?php echo $data->np_post_office;?></td>
            </tr>
            <tr>
                <td>Police station:</td>
                <td><?php echo $data->np_police_station;?></td>
                <td>District:</td>
                <td><?php echo $data->np_district;?></td>
            </tr>
        </table>
    </div>


</div>
