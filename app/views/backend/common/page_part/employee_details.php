<div class="row">
<div id="widget-grid" class="col-sm-12">       
    <div class="section">
        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
            <header>
                <h2>Employee Details</h2>
            </header>
            <div class="widget-body section_content employee_info">
                <div class="col-sm-4 col1">
                    <p>
                        <label>Name: </label> <?php echo $employee_info->full_name;?>
                    </p>
                    <p>
                        <label>Job title: </label> <?php echo $employee_info->job_title;?>
                    </p>

                    <p>
                        <label>Gender: </label> <?php echo $employee_info->gender;?>
                    </p>
                    <p>
                        <label>Mobile: </label> <?php echo $employee_info->mobile;?>
                    </p>
                    <p>
                        <label>Email: </label> <?php echo $employee_info->email;?>
                    </p>
                    
                </div>
                
                <div class="col-sm-4 col3">
                    <p>
                        <label>Address: </label> <?php echo $employee_info->address;?>
                    </p>
                    
                    <p>
                        <label>Marital status: </label> <?php echo $employee_info->marital_status;?>
                    </p>
                    <p>
                        <label>Joining date: </label> <?php echo $employee_info->joining_date;?>
                    </p>
                    <p>
                        <label>Qualification: </label> <?php echo $employee_info->qualification;?>
                    </p>
                    <p>
                        <label>Status: </label> <?php echo $employee_info->status==1?'Active':'Inactive';?>
                    </p>
                </div>

                <div class="col-sm-4 col2">
                    
                    <p>
                        <label>Basic salary: </label> <b><?php echo $this->payment->currencyFormat($employee_info->basic_salary);?></b>
                    </p>
                    <p>
                        <label>House rent: </label> <b><?php echo $this->payment->currencyFormat($employee_info->house_rent);?></b>
                    </p>
                    <p>
                        <label>Medical allownce: </label> <b><?php echo $this->payment->currencyFormat($employee_info->medical_allownce);?></b>
                    </p>
                    <p>
                        <label>Others allownce: </label> <b><?php echo $this->payment->currencyFormat($employee_info->other_allownce);?></b>
                    </p>
                    <p>
                        <label>Gross Total: </label> <b><?php echo $this->payment->currencyFormat($employee_info->total);?></b>
                    </p>

                    
                </div>

            </div>
        </div>    
    </div>
</div>
</div>