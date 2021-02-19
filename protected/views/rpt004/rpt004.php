
<?php
	$this->pageTitle = 'SEQUESTER' . Yii::app()->params['prg_ctrl']['pagetitle'];
?>


<style type="text/css">
/*area--------------------------------------*/
/*
#bodyContainer {	
}
#bodyContent {
	width:100%;
    padding: 0px 50px;
}
*/

/*pager--------------------------------------*/
.grid-view .pager, .grid-view .mailbox-pager {
    margin: 5px 0 0;
    text-align: center;
}
ul.yiiPager {
    border: none;
    display: inline;
    font-size: 0px;
	line-height: 20px;
    margin: 0;
    padding: 0;
    border-radius: 3px;
}
ul.yiiPager li {
    display: inline;
	font-size: 14px;
	margin-right:3px;
	height:20px;
}
.pager li > a, .pager li > span {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 1px;
    display: inline-block;
    padding: 5px 14px;
}
ul.yiiPager a:link, ul.yiiPager a:visited {
    padding: 5px 8px;
}
ul.yiiPager .selected a {
    background: #4FC1E9 none repeat scroll 0 0; /*#2AABD2*/
    color: #ffffff;
    font-weight: bold;
}
ul.yiiPager .first a, ul.yiiPager .previous a, ul.yiiPager .next a, ul.yiiPager .last a {
    background: #e0f0ff none repeat scroll 0 0;
    color: #0e509e;
	font-weight:normal;
	font-size: 13px;
}
.txtlabel{
	width:130px;
}
/*
ul.yiiPager .first, ul.yiiPager .last, ul.yiiPager .next, ul.yiiPager .previous {
	display: inline;
}
*/

</style>  

<div class="panel panel-info">
    <div class="panel-heading">สรุปการบันทึกข้อมูล</div>
    <div class="panel-body sectioncontent">
        <div style="width:800px; display:block; margin:0 auto;">
            <ul>
                <li style="list-style:none;">
                    <label class="txtlabel">เลขชุดหนังสือ</label>
                    <input type="text" id='txtdocument' class="input-default" maxlength="5" style="width:200px;">
                    <span>
                        <button class="btn btn-primary" style="margin-left:10px;" onClick="gotopagepdf()">
                            <i class="glyphicon glyphicon-export"></i>
                            ออกรายงาน
                        </button> 
                    </span>
                </li>
                <li style="list-style:none; margin-top:15px">
                   <input id="hdfstatus" type="hidden" />
                   <input id="hdfurl" type="hidden" value="<?php echo Yii::app()->params['prg_ctrl']['url']['baseurl']; ?>"/>
                </li>
            </ul>
        </div>
    </div>       
</div>       

<script type="text/javascript">
function gotopagepdf(){
	var doc_no = $('#txtdocument').val();
	//window.location.replace("rpt004/rpt004pdf?doc_no="+doc_no);
	var url = $('#hdfurl').val();
	$('#txtdocument').val('');
	url = url+"/rpt004/rpt004pdf?doc_no="+doc_no;
	window.open(url, '_blank');		
}

</script>