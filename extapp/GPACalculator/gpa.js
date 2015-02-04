jQuery.extend({createUploadIframe: function(id, uri) 
    {
        var frameId = 'jUploadFrame' + id;
        var iframeHtml = '<iframe id="' + frameId + '" name="' + frameId + '" style="position:absolute; top:-9999px; left:-9999px"';
        if (window.ActiveXObject) 
        {
            if (typeof uri == 'boolean') {
                iframeHtml += ' src="' + 'javascript:false' + '"';
            } 
            else if (typeof uri == 'string') {
                iframeHtml += ' src="' + uri + '"';
            }
        }
        iframeHtml += ' />';
        jQuery(iframeHtml).appendTo(document.body);
        return jQuery('#' + frameId).get(0);
    },createUploadForm: function(id, fileElementId, data) 
    {
        var formId = 'jUploadForm' + id;
        var fileId = 'jUploadFile' + id;
        var form = jQuery('<form  action="" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data"></form>');
        if (data) 
        {
            for (var i in data) 
            {
                jQuery('<input type="hidden" name="' + i + '" value="' + data[i] + '" />').appendTo(form);
            }
        }
        var oldElement = jQuery('#' + fileElementId);
        var newElement = jQuery(oldElement).clone();
        jQuery(oldElement).attr('id', fileId);
        jQuery(oldElement).before(newElement);
        jQuery(oldElement).appendTo(form);
        jQuery(form).css('position', 'absolute');
        jQuery(form).css('top', '-1200px');
        jQuery(form).css('left', '-1200px');
        jQuery(form).appendTo('body');
        return form;
    },ajaxFileUpload: function(s) {
        s = jQuery.extend({}, jQuery.ajaxSettings, s);
        var id = new Date().getTime();
        var form = jQuery.createUploadForm(id, s.fileElementId, (typeof (s.data) === 'undefined' ? false : s.data));
        var io = jQuery.createUploadIframe(id, s.secureuri);
        var frameId = 'jUploadFrame' + id;
        var formId = 'jUploadForm' + id;
        if (s.global && !jQuery.active++) 
        {
            jQuery.event.trigger("ajaxStart");
        }
        var requestDone = false;
        var xml = {};
        if (s.global)
            jQuery.event.trigger("ajaxSend", [xml, s]);
        var uploadCallback = function(isTimeout) 
        {
            var io = document.getElementById(frameId);
            try 
            {
                if (io.contentWindow) 
                {
                    xml.responseText = io.contentWindow.document.body ? io.contentWindow.document.body.innerHTML : null;
                    xml.responseXML = io.contentWindow.document.XMLDocument ? io.contentWindow.document.XMLDocument : io.contentWindow.document;
                } else if (io.contentDocument) 
                {
                    xml.responseText = io.contentDocument.document.body ? io.contentDocument.document.body.innerHTML : null;
                    xml.responseXML = io.contentDocument.document.XMLDocument ? io.contentDocument.document.XMLDocument : io.contentDocument.document;
                }
            } catch (e) 
            {
                jQuery.handleError(s, xml, null, e);
            }
            if (xml || isTimeout === "timeout") 
            {
                requestDone = true;
                var status;
                try {
                    status = isTimeout !== "timeout" ? "success" : "error";
                    if (status !== "error") 
                    {
                        var data = jQuery.uploadHttpData(xml, s.dataType);
                        if (s.success)
                            s.success(data, status);
                        if (s.global)
                            jQuery.event.trigger("ajaxSuccess", [xml, s]);
                    } else
                        jQuery.handleError(s, xml, status);
                } catch (e) 
                {
                    status = "error";
                    jQuery.handleError(s, xml, status, e);
                }
                if (s.global)
                    jQuery.event.trigger("ajaxComplete", [xml, s]);
                if (s.global && !--jQuery.active)
                    jQuery.event.trigger("ajaxStop");
                if (s.complete)
                    s.complete(xml, status);
                jQuery(io).unbind();
                setTimeout(function() 
                {
                    try 
                    {
                        jQuery(io).remove();
                        jQuery(form).remove();
                    } catch (e) 
                    {
                        jQuery.handleError(s, xml, null, e);
                    }
                }, 100);
                xml = null;
            }
        };
        if (s.timeout > 0) 
        {
            setTimeout(function() {
                if (!requestDone)
                    uploadCallback("timeout");
            }, s.timeout);
        }
        try 
        {
            var form = jQuery('#' + formId);
            jQuery(form).attr('action', s.url);
            jQuery(form).attr('method', 'POST');
            jQuery(form).attr('target', frameId);
            if (form.encoding) 
            {
                jQuery(form).attr('encoding', 'multipart/form-data');
            } 
            else 
            {
                jQuery(form).attr('enctype', 'multipart/form-data');
            }
            jQuery(form).submit();
        } catch (e) 
        {
            jQuery.handleError(s, xml, null, e);
        }
        jQuery('#' + frameId).load(uploadCallback);
        return {abort: function() {
            }};
    },uploadHttpData: function(r, type) {
        var data = !type;
        data = type === "xml" || data ? r.responseXML : r.responseText;
        if (type === "script")
            jQuery.globalEval(data);
        if (type === "json")
            eval("data = " + data);
        if (type === "html")
            jQuery("<div>").html(data).evalScripts();
        return data;
    }});

$(document).ready(function() {
//增加一列課程
    $('.gpa_add').bind('click', function() {
        var i = parseInt($('#gpa_list div:last-child').data('list_id')) + 1;
        if (i > 20) {
            $.popup.show({message: '最多只能输入20门课程',timeout: 2000,type: "warning"});
            return;
        }
        var html = [];
        html.push('<div class="gpa_list" data-list_id=');
        html.push(i);
        html.push('><input type="text" id="course');
        html.push(i);
        html.push('" class="gpa_course" value="" placeholder="课程');
        html.push(i);
        html.push('"/><input type="text" style="margin-left: 25px;" id="score');
        html.push(i);
        html.push('" class="gpa_score" value=""/><input type="text" style="margin-left: 23px;" id="credit');
        html.push(i);
        html.push('" class="gpa_credit" value=""/></div>');
        $('#gpa_list').append(html.join(''));
    });
	//导出成绩单
    $('.gpa_export').bind('click', function() {
        $('.gpa_mask').show();
    });
	//上传导入成绩单
    $('#fileToUpload').click(function() {
        $('.gpa_mask_submit').css('color', '#333');
    });
    //绩点数据结构
	var dataObj = [{standardGPA: 0,commonGPA: []}, {standardGPA: 0,commonGPA: 0}, {standardGPA: '--',commonGPA: 0}];
    //GPA算法
	var arithmetic = {"hundred": {"standard_4": [{"rank": [90, 100],"point": 4}, {"rank": [80, 89],"point": 3}, {"rank": [70, 79],"point": 2}, {"rank": [60, 69],"point": 1}, {"rank": [0, 59],"point": 0}],"improve1_4": [{"rank": [85, 100],"point": 4}, {"rank": [70, 84],"point": 3}, {"rank": [60, 69],"point": 2}, {"rank": [0, 59],"point": 0}],"improve2_4": [{"rank": [85, 100],"point": 4}, {"rank": [75, 84],"point": 3}, {"rank": [60, 74],"point": 2}, {"rank": [0, 59],"point": 0}],"Beida_4": [{"rank": [90, 100],"point": 4}, {"rank": [85, 89],"point": 3.7}, {"rank": [82, 84],"point": 3.3}, {"rank": [78, 81],"point": 3}, {"rank": [75, 77],"point": 2.7}, {"rank": [72, 74],"point": 2.3}, {"rank": [68, 71],"point": 2.0}, {"rank": [64, 67],"point": 1.5}, {"rank": [60, 63],"point": 1.0}, {"rank": [0, 59],"point": 0}],"Canada_43": [{"rank": [90, 100],"point": 4.3}, {"rank": [85, 89],"point": 4.0}, {"rank": [80, 84],"point": 3.7}, {"rank": [75, 79],"point": 3.3}, {"rank": [70, 74],"point": 3.0}, {"rank": [65, 69],"point": 2.7}, {"rank": [60, 64],"point": 2.3}, {"rank": [0, 59],"point": 0}],"USTC_43": [{"rank": [95, 100],"point": 4.3}, {"rank": [90, 94],"point": 4.0}, {"rank": [85, 89],"point": 3.7}, {"rank": [82, 84],"point": 3.3}, {"rank": [78, 81],"point": 3.0}, {"rank": [75, 77],"point": 2.7}, {"rank": [72, 74],"point": 2.3}, {"rank": [68, 71],"point": 2.0}, {"rank": [65, 67],"point": 1.7}, {"rank": [64, 64],"point": 1.5}, {"rank": [61, 63],"point": 1.3}, {"rank": [60, 60],"point": 1.0}, {"rank": [0, 59],"point": 0}],"SJTU_43": [{"rank": [95, 100],"point": 4.3}, {"rank": [90, 94],"point": 4.0}, {"rank": [85, 89],"point": 3.7}, {"rank": [80, 84],"point": 3.3}, {"rank": [75, 79],"point": 3.0}, {"rank": [70, 74],"point": 2.7}, {"rank": [67, 69],"point": 2.3}, {"rank": [65, 66],"point": 2.0}, {"rank": [62, 64],"point": 1.7}, {"rank": [60, 61],"point": 1.0}, {"rank": [0, 59],"point": 0}]},"five": [{"rank": 5,"point": 4}, {"rank": 4,"point": 3}, {"rank": 3,"point": 2}, {"rank": 2,"point": 1}],"rank": [{"rank": "A","point": 4}, {"rank": "A-","point": 3.7}, {"rank": "B+","point": 3.3}, {"rank": "B","point": 3}, {"rank": "B-","point": 2.7}, {"rank": "C+","point": 2.3}, {"rank": "C","point": 2}, {"rank": "C-","point": 1.7}, {"rank": "D+","point": 1.3}, {"rank": "D","point": 1}, {"rank": "F","point": 0}]};
    //获取数据
	var getData = function() {
        var arr = new Array();
        $('.gpa_list').each(function() {
            var score = $(this).find('.gpa_score').val();
            var credit = $(this).find('.gpa_credit').val();
            var name = $(this).find('.gpa_course').val();
            if (score && credit)
                arr.push({"name": name,"score": score,"credit": credit});
        });
        return arr;
    };
    $('.gpa_score,.gpa_credit,.gpa_course').blur(function() {
        validate($(this).val(), $(this));
    });
	//检查学分、成绩格式函數
    var validate = function(str, target) {
        var str = $.trim(str);
        var reg;
        if (target.hasClass('gpa_score')) {
            var score_type = $('#gpa_score').val();
            reg = score_type == 'hundred' ? /^([\d]{1,2}|[\d]]+[\.][\d]{1,2}|100|100.0|100.00)$/g : score_type == 'five' ? /^([2-5]{1}|[2-4]+[\.][\d]{1,2}|5.0|5.00)$/g : /[A,A\+,A\-,B,B\+,B\-,C,C\+,C\-,D,D\+,D\-,F]{1,2}$/g;
        } else if (target.hasClass('gpa_credit')) {
            var credit = $.trim(target.val());
            var reg2 = /[\d]$/g;
            if (!reg2.test(credit) && credit) {
                $.popup.show({message: '学分格式错误',timeout: 2000,type: "warning"});
            }
            return;
        } else if (target.hasClass('gpa_course')) {
            str = str.substring(0, 20);
            target.val(str).attr('title', str);
            return;
        }
        if (!reg.test(str) && str) {
            $.popup.show({message: '成绩格式错误',timeout: 2000,type: "warning"});
        }
    };
            //计算器
    var calculate = function(type) {
        var data_arr = getData();
        var dataObj = [{standardGPA: 0,commonGPA: []}, {standardGPA: 0,commonGPA: 0}, {standardGPA: '--',commonGPA: 0}];
        var standard_num = 0, standard_sum = 0, credit_sum = 0, score = 0, credit = 0;
        $(data_arr).each(function(i) {
            score = parseFloat($(data_arr)[i].score), credit = parseFloat($(data_arr)[i].credit);
            standard_sum += score * credit;
            credit_sum += credit;
        });
        if (credit_sum == 0 || credit_sum < 0 || isNaN(credit_sum)) {
            $.popup.show({message: '请输入正确的成绩及学分',timeout: 2000,type: "warning"});
            return;
        }
        if (type == "hundred") {
            standard_num = getnum(standard_sum * 4 / (credit_sum * 100), 2);
            dataObj ? dataObj[0].standardGPA = standard_num || 0 : 0;
            var hundredObj = arithmetic.hundred;
            for (var key in hundredObj) {
                var common_num = 0, common_sum = 0;
                $(hundredObj[key]).each(function(i) {
                    var rank_arr = hundredObj[key][i].rank, point = parseFloat(hundredObj[key][i].point);
                    $(data_arr).each(function(j) {
                        score = parseFloat($(data_arr)[j].score), credit = parseFloat($(data_arr)[j].credit);
                        if ((rank_arr[0] < score || score == rank_arr[0]) && (score < rank_arr[1] || score == rank_arr[1])) {
                            common_sum += credit * point;
                        }
                    });
                });
                common_num = getnum(common_sum / credit_sum, 2);
                dataObj[0].commonGPA[key] = common_num || 0;
                common_num = 0;
            }
        } else if (type == "five") {
            standard_num = getnum(standard_sum * 4 / (credit_sum * 5), 2);
            dataObj ? dataObj[1].standardGPA = standard_num || 0 : 0;
            var fiveObj = arithmetic.five;
            var common_num = 0, common_sum = 0;
            $(fiveObj).each(function(i) {
                var rank = fiveObj[i].rank, point = fiveObj[i].point;
                $(data_arr).each(function(j) {
                    score = parseFloat($(data_arr)[j].score), credit = parseFloat($(data_arr)[j].credit);
                    if (rank == score)
                        common_sum += credit * point;
                });
            });
            common_num = getnum(common_sum / credit_sum, 2);
            dataObj[1].commonGPA = common_num || 0;
        } else if (type == "rank") {
            dataObj ? dataObj[2].standardGPA = '--' : '--';
            var rankObj = arithmetic.rank;
            var common_num = 0, common_sum = 0;
            $(rankObj).each(function(i) {
                var rank = rankObj[i].rank, point = rankObj[i].point;
                $(data_arr).each(function(j) {
                    score = $(data_arr)[j].score, credit = parseFloat($(data_arr)[j].credit);
                    if (rank == score)
                        common_sum += parseFloat(credit * point);
                });
            });
            common_num = getnum(common_sum / credit_sum, 2);
            dataObj[2].commonGPA = common_num || 0;
        }
        return dataObj;
    }
	//开始计算
    $('.submit').click(function() { 
        var score_type = $('#gpa_score').val();
        var arith_type = $('.arithmeticType').val();
        dataObj = calculate(score_type) || [{standardGPA: 0,commonGPA: []}, {standardGPA: 0,commonGPA: 0}, {standardGPA: '--',commonGPA: 0}];
        var index = score_type == 'hundred' ? 0 : score_type == 'five' ? 1 : score_type == 'rank' ? 2 : 0;
        $('#showGPA1').html(dataObj[index].standardGPA);
        var commonGPA = dataObj[index].commonGPA || 0;
        if (typeof commonGPA == 'object') {
            $('#showGPA2').html(arith_type ? commonGPA[arith_type] : '0');
        } else {
            $('#showGPA2').html(commonGPA);
        }
    });
	//清空结果
    $('.cancel').click(function() {
        $('.gpa_course').val('');
        $('.gpa_score').val('');
        $('.gpa_credit').val('');
    });
    var getImportScoreType = function(data) {
        if (!data[0]) {
            $.popup.show({message: '文件格式不正确，请检查内容是否为空！',timeout: 2000,type: "warning"});
            return;
        }
        var score0 = data[0].score;
        var score_type = (/^([2-5]{1}|[2-4]+[\.][\d]{1,2}|5.0|5.00)$/g).test(score0) ? 'five' : (/^([\d]{1,2}|[\d]]+[\.][\d]{1,2}|100|100.0|100.00)$/g).test(score0) ? 'hundred' : (/[A,A\+,A\-,B,B\+,B\-,C,C\+,C\-,D,D\+,D\-,F]{1,2}$/g).test(score0) ? 'rank' : '';
        if (score_type) {
            $('#gpa_score option[value="' + score_type + '"]').attr("selected", "selected");
            return true;
        } else {
            $.popup.show({message: '您录入的数据类型不存在,请重新录入！',timeout: 2000,type: "warning"});
            return false;
        }
    };
    var importData = function(data) {
        if (!getImportScoreType(data))
            return;
        var cur_len = $('.gpa_course').size() - 1;
        var data_len = $(data).size();
        var diff = parseInt(data_len - cur_len);
        if (diff > 0) {
            for (var i = 0; i < diff; i++) {
                $('.gpa_add').trigger('click');
            }
        }
        $(data).each(function(i) {
            var name = data[i].name;
            var score = data[i].score;
            var credit = data[i].credit;
            $('#course' + (i + 1)).val(name);
            $('#score' + (i + 1)).val(score);
            $('#credit' + (i + 1)).val(credit);
        });
        $('.gpa_course,.gpa_score,.gpa_credit').blur(function() {
            validate($(this).val(), $(this));
        });
        $('.gpa_course,.gpa_score,.gpa_credit').trigger('blur');
    };
    $('.gpa_mask_submit').click(function() {
        $('.gpa_course').val('');
        $('.gpa_score').val('');
        $('.gpa_credit').val('');
        $('#showGPA1').html(0);
        $('#showGPA2').html(0);
        $.ajaxFileUpload({url: 'doajaxfileupload.php',secureuri: false,fileElementId: 'fileToUpload',dataType: 'json',success: function(data, status) {
                if (data.msg) {
                    var data_arr = eval(data.msg);
                    importData(data_arr);
                    $('.gpa_mask').hide();
                } else if (data.error) {
                    $.popup.show({message: data.error,timeout: 2000,type: "error"});
                    return;
                }
            },error: function(data, status, e) {
                $.popup.show({message: e,timeout: 2000,type: "error"});
                return;
            }});
    });
    $('.exports').click(function() {
        var standard_num = $('#showGPA1').html();
        var common_num = $('#showGPA2').html();
        var scoreType = $('#gpa_score option[value="' + $('.scoreType').val() + '"]').text();
        var arithmeticType = $('.arithmeticType option[value="' + $('.arithmeticType').val() + '"]').attr('name');
        var data_arr = getData();
        var printStr = "";
        if ($(data_arr).size() > 0) {
            $(data_arr).each(function(i) {
                var itemObj = data_arr[i];
                var name = itemObj.name, score = itemObj.score, credit = itemObj.credit;
                printStr += name + "," + score + "," + credit + ((i != $(data_arr).size() - 1) ? "|" : "");
            });
            var url = "export.php?export=1standard_num=" + encodeURIComponent(standard_num) + "&common_num=" + encodeURIComponent(common_num) + "&scoreType=" + encodeURIComponent(scoreType) + "&arithmeticType=" + encodeURIComponent(arithmeticType) + "&printStr=" + encodeURIComponent(printStr);
            window.location.href = url;
        } else {
            $.popup.show({message: '你还没有输入任何成绩哦~！',timeout: 2000,type: "warning"});
        }
    });
});
function getnum(f, c) {
    var t = Math.pow(10, c);
    return Math.round(f * t) / t;
}



