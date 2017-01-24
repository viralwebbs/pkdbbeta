
<?PHP  //echo "<pre>"; print_r($alljob); echo "</pre>"; ?>
    <section class="home">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
            <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Assign Task</h3>
            </div>
            <div class="panel-body">
              <form>
              <?PHP if( isset($alljob) && is_array($alljob) && !empty($alljob) ){ ?>
								
								
					<?PHP foreach($alljob as $rowjob){
                            $job_id =$rowjob['id'];
                            $job_title= $rowjob['job_title'];
						    $job_status= $rowjob['job_status'];
					}
					
					}
                      ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <label>Project Title</label>
                      </div>
                      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <p><?PHP echo (isset($job_title)) ? ($job_title) : (''); ?> </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <label>Job No</label>
                      </div>
                      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <p><?PHP echo (isset($job_id)) ? ($job_id) : (''); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="input-field">
                          <input id="start_date" type="text" class="validate">
                          <label for="start_date">Start Date</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="input-field">
                          <input id="end_date" type="text" class="validate">
                          <label for="end_date">End Date</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <label class="re-emp">Recommended Employees</label>
                      </div>
                      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <select class="form-control" id="#emp-name" multiple="multiple">
                            <option>Osama Arshad</option>
                            <option>Zahid Ali</option>
                            <option>Touqeer</option>
                            <option>Mohsin Ali</option>
                            <option>Zain</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="input-field">
                          <input id="hour" type="text" class="validate">
                          <label for="hour">No. of hour</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <label class="status-label">Status</label>
                      </div>
                      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <select class="form-control status">
                            <?PHP echo $this->functions->DropDown("job_status","status_id","status","","",$job_status); ?> 
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <label class="des">Project Coordinator Description</label>
                      </div>
                      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <textarea class="form-control" rows="10"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <button type="submit" class="btn btn-default">Save</button>
                </div>
                <div class="clearfix"></div>
            </form>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>