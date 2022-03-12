/**
 * uut.js
 * Ubah saja sesuka hatimu
 */
 
  function isNumberKey(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
     return true;
  }
  
  function isNumberKeyDecimal(evt)
  {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 
      && (charCode < 48 || charCode > 57))
       return false;
    return true;
  }
  
  function FormatCurrency(objNum)
  {
     var num = objNum.value
     var ent, dec;
     if (num != '' && num != objNum.oldvalue)
     {
       num = HapusTitik(num);
       if (isNaN(num))
       {
         objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
       } else {
         var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
         if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
         {
           alert(num.split('.')[1]);
           objNum.value = TambahTitik(num.split('.')[0])+'.'+num.split('.')[1];
         }
         else
         {
           objNum.value = TambahTitik(num.split('.')[0]);
         }
         objNum.oldvalue = objNum.value;
       }
     }
  }

  function HapusTitik(num)
  {
     return (num.replace(/\./g, ''));
  }

  function TambahTitik(num)
  {
     numArr=new String(num).split('').reverse();
     for (i=3;i<numArr.length;i+=3)
     {
       numArr[i]+='.';
     }
     return numArr.reverse().join('');
  }
         
  function CekInputValid(parameter) {
  for (i=0; i<parameter.length; i++) {
      if ( $('#'+parameter[i]+'').val() == '' ) {
        $('#'+parameter[i]+'').css('background-color', '#DFB5B4');
      } else {
        $('#'+parameter[i]+'').removeAttr('style');
      }
    }
  }
  
  function InputValid(parameter) {
  for (i=0; i<parameter.length; i++) {
      if ( $('#'+parameter[i]+'').val() == '' ) {
        $('#'+parameter[i]+'').css('background-color', '#DFB5B4');
      } else {
        $('#'+parameter[i]+'').removeAttr('style');
      }
    }
  }
  
  function RequiredValid(parameterRv) {
  var a = 0;
  for (i=0; i<parameterRv.length; i++) {
      if ( $('#'+parameterRv[i]+'').val() == '' ) {
        
      } else {
        a = a + 1;
      }
    }
    if (a<parameterRv.length){
      return 0;
      }
    else{
      return 1;
      }
  }
  
  function SimpanData(parameter, url) {
    $.ajax({
      type: 'POST',
      async: true,
      data: parameter,
      dataType: 'text',
      url: url,
      success: function(text) {
        if(text == '0'){
          alertify.error('Data gagal disimpan');
        }
        else if(text == '9999'){
          alertify.error('Data gagal disimpan, karena ada duplikasi');
        }
        else{
          alertify.success('Data berhasil disimpan');
          AfterSaved();
        }
        overlay_fadeout();
      }
    });
  }
  
  function SimpanDataReturn(parameter, url, idName) {
    $.ajax({
      type: 'POST',
      async: true,
      data: parameter,
      dataType: 'text',
      url: url,
      success: function(text) {
        if(text == '0'){
          alertify.error('Data gagal disimpan');
        }
        else if(text == '9999'){
          alertify.error('Data gagal disimpan, karena ada duplikasi');
        }
        else{
          alertify.success('Data berhasil disimpan');
          $('#'+idName+'').val(text);
        }
      }
    });
  }
  
  function UpdateData(parameter, url) {
    $.ajax({
      type: 'POST',
      async: true,
      data: parameter,
      dataType: 'text',
      url: url,
      success: function(text) {
        if(text == '0'){
          alertify.error('Data gagal disimpan');
        }
        else if(text == '9999'){
          alertify.error('Data gagal disimpan, karena ada duplikasi');
        }
        else{
          alertify.success('Data berhasil disimpan');
        }
        overlay_fadeout();
      }
    });
  }
  
  function SimpanDataCustom(parameter, url) {
    var result = $.ajax({
      type: 'GET',
      data: parameter,
      
        contentType: "Content-Type: multipart/form-data; charset=utf-8",
        dataType: "json",
        async: false,
        
      url: url,
      success: function(text) {
        if(text == 0){
          //alertify.error('Data gagal disimpan');
        }
        else{
          //alertify.success('Data berhasil disimpan');
        }
      }
    }) .responseText ;
    return  result;
  }
  
  function SimpanDataCustomGet(parameter, url) {
    var result = $.ajax({
      type: 'GET',
      data: parameter,
      
        contentType: "Content-Type: multipart/form-data; charset=utf-8",
        dataType: "json",
        async: false,
        
      url: url,
      success: function(text) {
        if(text == 0){
          //alertify.error('Data gagal disimpan');
        }
        else{
          //alertify.success('Data berhasil disimpan');
        }
      }
    }) .responseText ;
    return  result;
  }
  
  function SimpanDataCustomPost(parameter, url) {
    var result = $.ajax({
      type: 'POST',
      data: parameter,
      
        contentType: "Content-Type: multipart/form-data; charset=utf-8",
        dataType: "json",
        async: true,
        
      url: url,
      success: function(text) {
        if(text == 0){
          //alertify.error('Data gagal disimpan');
        }
        else{
          //alertify.success('Data berhasil disimpan');
        }
      }
    }) .responseText ;
    return  result;
  }
  
  function HapusAttachment(parameter, url) {
    $.ajax({
      type: 'POST',
      async: true,
      data: parameter,
      dataType: 'text',
      url: url,
      success: function(text) {
        if(text == 1){
          alertify.success('File berhasil dihapus');
        }
        else{
          alertify.error('File gagal dihapus');
        }
      }
    });
  }
  
  function HapusData(parameter, url) {
    $.ajax({
      type: 'POST',
      async: true,
      data: parameter,
      dataType: 'text',
      url: url,
      success: function(text) {
        if(text == 1){
          alertify.success('Data berhasil dihapus');
        }
        else{
          alertify.error('Data gagal dihapus');
        }
      }
    });
  }
  
  function TotalData(url) {
    var result = $.ajax({
        type: "POST",
        url: url,
        param: '{}',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (data) {
            // nothing needed here
      }
    }) .responseText ;
    return  result;
  }
  
  function limit_per_page() {
    return 10;
  }
  
  function limit_per_page_custome(a) {
    return a;
  }
  
  function tanggalan(tanggal) {
    var arr = tanggal.split('-');
    var panjang =arr.length;
    if( panjang == 3){
      var thn = arr[0];
      if( thn < 1000){
        var tahunnya ='<span style="color:red">.</span>';
      }
      else if ( thn > 2050) {
        var tahunnya ='<span style="color:red">.</span>';
      }
      else{
        var tahunnya=thn;
      }
      
      var bln = arr[1];
      if( bln == '01'){
        var b = 'Januari';
        var b1=1;
      }
      else if ( bln == '02') {
        var b = 'Februari';
        var b1=2;
      }
      else if ( bln == '03') {
        var b = 'Maret';
        var b1=3;
      }
      else if ( bln == '04') {
        var b = 'April';
        var b1=4;
      }
      else if ( bln == '05') {
        var b = 'Mei';
        var b1=5;
      }
      else if ( bln == '06') {
        var b = 'Juni';
        var b1=6;
      }
      else if ( bln == '07') {
        var b = 'Juli';
        var b1=7;
      }
      else if ( bln == '08') {
        var b = 'Agustus';
        var b1=8;
      }
      else if ( bln == '09') {
        var b = 'September';
        var b1=9;
      }
      else if ( bln == '10') {
        var b = 'Oktober';
        var b1=10;
      }
      else if ( bln == '11') {
        var b = 'November';
        var b1=11;
      }
      else if ( bln == '12') {
        var b = 'Desember';
        var b1=12;
      }
      else{
       var b = '<span style="color:red">.</span>';
       var b1=13;
      }
      
      if( b1 > 12){
        var bulannya= b;
      }
      else{
        var bulannya= b;
      }
      
      var tgl = arr[2];
      if( tgl == '01'){
        var c1=1;
      }
      else if ( tgl == '02') {
        var c1=2;
      }
      else if ( tgl == '03') {
        var c1=3;
      }
      else if ( tgl == '04') {
        var c1=4;
      }
      else if ( tgl == '05') {
        var c1=5;
      }
      else if ( tgl == '06') {
        var c1=6;
      }
      else if ( tgl == '07') {
        var c1=7;
      }
      else if ( tgl == '08') {
        var c1=8;
      }
      else if ( tgl == '09') {
        var c1=9;
      }
      else{
        var c1=tgl;
      }
      
      var tanggalnya = tgl;
      
      var ho = ''+tanggalnya+' '+bulannya+' '+tahunnya+'';
      return ho;
    }
    else{
      return '<span style="color:red">.</span>';
    }
  }
   
  function waktu(tanggal) {
    
    var full = tanggal.split(' ');
    
    var arr = full[0].split('-');
		var bln = arr[1];
    if( bln == '01'){
      var b = 'Januari';
    }
    else if ( bln == '02') {
      var b = 'Februari';
    }
    else if ( bln == '03') {
      var b = 'Maret';
    }
    else if ( bln == '04') {
      var b = 'April';
    }
    else if ( bln == '05') {
      var b = 'Mei';
    }
    else if ( bln == '06') {
      var b = 'Juni';
    }
    else if ( bln == '07') {
      var b = 'Juli';
    }
    else if ( bln == '08') {
      var b = 'Agustus';
    }
    else if ( bln == '09') {
      var b = 'September';
    }
    else if ( bln == '10') {
      var b = 'Oktober';
    }
    else if ( bln == '11') {
      var b = 'November';
    }
    else if ( bln == '12') {
      var b = 'Desember';
    }
    else{
      var b = '??';
    }
    
    if( full[0] == '0000-00-00'){
      var w = '-';
    }
    else{
      var w = ''+arr[2]+' '+b+' '+arr[0]+' '+full[1]+'';
    }
    
		
    return w;
  }
  
  function rupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  function xls_mode(limit) {
    
      $('#pagination').hide();
      for (var i = 0; i <= limit; i++) {
      $('#th_'+i+'_1').hide();
      
      $('#td_0_'+i+'').hide();
      $('#td_1_'+i+'').hide();
      $('#td_2_'+i+'').hide();
      $('#td_3_'+i+'').hide();
      $('#td_4_'+i+'').hide();
      $('#td_5_'+i+'').hide();
      $('#td_6_'+i+'').hide();
      $('#td_7_'+i+'').hide();
      $('#td_8_'+i+'').hide();
      $('#td_9_'+i+'').hide();
    }
    
    $('#btnExport').show();
    $('#resetExport').show();
    $('#pre_exel').hide();
  }
  
  function web_mode(limit) {
    $('#pagination').show();
    for (var i = 0; i <= limit; i++) {
      $('#th_'+i+'_1').show();
      
      $('#td_0_'+i+'').show();
      $('#td_1_'+i+'').show();
      $('#td_2_'+i+'').show();
      $('#td_3_'+i+'').show();
      $('#td_4_'+i+'').show();
      $('#td_5_'+i+'').show();
      $('#td_6_'+i+'').show();
      $('#td_7_'+i+'').show();
      $('#td_8_'+i+'').show();
      $('#td_9_'+i+'').show();
    }
    $('#btnExport').hide();
    $('#resetExport').hide();
    $('#pre_exel').show();
  }

  function xls_mode_rem(limit) {
      for (var i = 0; i <= limit; i++) {
      $('#th_'+i+'_1').remove();
      
      $('#td_0_'+i+'').remove();
      $('#td_1_'+i+'').remove();
      $('#td_2_'+i+'').remove();
      $('#td_3_'+i+'').remove();
      $('#td_4_'+i+'').remove();
      $('#td_5_'+i+'').remove();
      $('#td_6_'+i+'').remove();
      $('#td_7_'+i+'').remove();
      $('#td_8_'+i+'').remove();
      $('#td_9_'+i+'').remove();
      $('#td_10_'+i+'').remove();
    }
    
    $('#btnExport').show();
  }
  
  function web_mode_rem(limit) {
    $('#pagination').show();
    for (var i = 0; i <= limit; i++) {
      $('#th_'+i+'_1').show();
      
      $('#td_0_'+i+'').show();
      $('#td_1_'+i+'').show();
      $('#td_2_'+i+'').show();
      $('#td_3_'+i+'').show();
      $('#td_4_'+i+'').show();
      $('#td_5_'+i+'').show();
      $('#td_6_'+i+'').show();
      $('#td_7_'+i+'').show();
      $('#td_8_'+i+'').show();
      $('#td_9_'+i+'').show();
    }
    $('#btnExport').hide();
    $('#resetExport').hide();
    $('#pre_exel').show();
  }
  
  function tangal_format_indo(tanggal) {
    var full = tanggal.split(' ');
    var arr = full[0].split('-');
    var w = ''+arr[2]+'/'+arr[1]+'/'+arr[0]+'';
    return w;
  }
  
  function tanggal_input_format_indo(tanggal) {
    var full = tanggal.split(' ');
    var arr = full[0].split('-');
    var w = ''+arr[2]+'-'+arr[1]+'-'+arr[0]+'';
    return w;
  }
  
  function fulform() {
    $('html, body').animate({
      scrollTop: $('#fullform').offset().top
    }, 1000);
  }
  
  function getAge(birth) {
  ageMS = Date.parse(Date()) - Date.parse(birth);
  age = new Date();
  age.setTime(ageMS);
  ageYear = age.getFullYear() - 1970;

  return ageYear;

  // ageMonth = age.getMonth(); // Accurate calculation of the month part of the age
  // ageDay = age.getDate();    // Approximate calculation of the day part of the age
  }
  
  function SelisihBulan(birth) {
  ageMS = Date.parse(Date()) - Date.parse(birth);
  age = new Date();
  age.setTime(ageMS);
  ageYear = age.getFullYear() - 1970;
  ageMonth = age.getMonth();

  return ageYear;

  // ageMonth = age.getMonth(); // Accurate calculation of the month part of the age
  // ageDay = age.getDate();    // Approximate calculation of the day part of the age
  }
