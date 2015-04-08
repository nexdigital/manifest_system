<style type="text/css">
div.panel-title { font-size: 12px; }
span.pull-right{ color: #000000; }
</style>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Setting
                </div>
                <div class="panel-body">
                    <div id="accordion">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" aria-expanded="false" class="collapsed">
                                        NT Kurs <span class="pull-right text-muted medium"><em><?=$this->tools->get_nt_kurs()?></em></span>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <form class="form-inline" id="form_nt_kurs" action="<?=site_url('administrator/ajax/set_nt_kurs')?>" method="post">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="value" value="<?=$this->tools->get_nt_kurs()?>" required>
                                      </div>
                                      <div class="form-group pull-right">
                                          <button type="submit" class="btn btn-success btn-sm">Save</button>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                        USD Kurs
                                        <span class="pull-right text-muted medium"><em><?=$this->tools->get_usd_kurs()?></em></span>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-collapse collapse" id="collapseTwo" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <form class="form-inline" id="form_usd_kurs" action="<?=site_url('administrator/ajax/set_usd_kurs')?>" method="post">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="value" value="<?=$this->tools->get_usd_kurs()?>" required>
                                      </div>
                                      <div class="form-group pull-right">
                                          <button type="submit" class="btn btn-success btn-sm">Save</button>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                        Deadline day(s)
                                        <span class="pull-right text-muted medium"><em><?=$this->tools->get_deadline_days()?> Day(s)</em></span>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-collapse collapse" id="collapseThree" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <form class="form-inline" id="form_deadline_days" action="<?=site_url('administrator/ajax/set_deadline_days')?>" method="post">
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="value" value="<?=$this->tools->get_deadline_days()?>" required>
                                        Days
                                      </div>
                                      <div class="form-group pull-right">
                                          <button type="submit" class="btn btn-success btn-sm">Save</button>
                                      </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    $('#form_nt_kurs, #form_usd_kurs, #form_deadline_days').ajaxForm({
        success:function(){
            location.reload();
        }
    });
})
</script>