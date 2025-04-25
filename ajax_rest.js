$(document).ready(function () {
    $("form").submit(function (event) {
      event.preventDefault(); // предотвратить стандартную отправку формы
  
      var formData = {
        query: $("#ip").val(),
      };
  
      var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip=";
      var token = "310053b85f71f015fc66028665818046861e1522";
  
      $.ajax({
        type: "GET",
        url: url + formData.query,
        beforeSend: function (xhr) {
          xhr.setRequestHeader("Authorization", "Token " + token);
        },
        dataType: "json",
        encode: true,
      }).done(function (result) {
        console.log(result);
        if (result && result.location && result.location.data && result.location.data.city) {
          $("#result").html("Город: <strong>" + result.location.data.city + "</strong>");
        } else {
          $("#result").html("Информация о городе не найдена.");
        }
      }).fail(function (xhr, status, error) {
        console.error("Ошибка запроса:", status, error);
        $("#result").html("Ошибка при получении данных.");
      });
    });
  });