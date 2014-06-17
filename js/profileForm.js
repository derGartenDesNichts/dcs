$('#country').live('change',function(){

    var countryId = $('#country option:selected').val();

    $.post(ajaxUrl+"/getDistricts", {countryId: countryId}, function(response) {

        $('#districts').html(response);
    });
});

$('#districts').live('change',function(){

    var districtId = $('#districts option:selected').val();

    $.post(ajaxUrl+"/getCities", {districtId: districtId}, function(response) {

        $('#city').html(response);
    });
});