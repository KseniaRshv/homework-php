<?
// Подключаем пролог ядра Bitrix
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

// Устанавливаем заголовок страницы 
$APPLICATION->SetTitle("AJAX");

    // Подключаем ядро JS библиотеки Bitrix и инициализируем модуль 'ajax'
    CJSCore::Init(array('ajax'));

    // Уникальный идентификатор для обработки ajax-запроса 
    $sidAjax = 'testAjax';

// Проверка, был ли выполнен ajax-запрос с нужным идентификатором 
if(isset($_REQUEST['ajax_form']) && $_REQUEST['ajax_form'] == $sidAjax){
   // Очищаем буфер вывода для корректной отправки JSON
   $GLOBALS['APPLICATION']->RestartBuffer();

   // Возвращаем данные в формате JSON с результатом и ошибкой (если есть) 
   echo CUtil::PhpToJSObject(array(
            'RESULT' => 'HELLO',
            'ERROR' => ''
   ));
   // Завершаем выполнение скрипта после отправки данных
   die();
}
?>

<!-- HTML-разметка для блока с результатами и индикатором загрузки -->
<div class="group">
   <div id="block"></div >
   <div id="process">wait ... </div >
</div>

<script>
   // Включаем режим отладки Bitrix (вывод отладочной информации)
   window.BXDEBUG = true;

   // Функция отправки AJAX-запроса
   function DEMOLoad(){
      // Скрываем блок с результатами
      BX.hide(BX("block"));
      // Показываем индикатор загрузки
      BX.show(BX("process"));
      // Отправляем AJAX-запрос и передаём функцию-обработчик DEMOResponse
      BX.ajax.loadJSON(
         '<?=$APPLICATION->GetCurPage()?>?ajax_form=<?=$sidAjax?>',
         DEMOResponse
      );
   }

   // Обработчик ответа от сервера
   function DEMOResponse (data){
      // Выводим отладочную информацию в консоль
      BX.debug('AJAX-DEMOResponse ', data);
      // Вставляем полученный результат в HTML-блок
      BX("block").innerHTML = data.RESULT;
      // Показываем блок с результатами
      BX.show(BX("block"));
      // Скрываем индикатор загрузки
      BX.hide(BX("process"));

      // Генерируем кастомное событие 'DEMOUpdate' для блока
      BX.onCustomEvent(
         BX(BX("block")),
         'DEMOUpdate'
      );
   }

   // Код, который будет выполнен после загрузки DOM
   BX.ready(function(){
      /*
      // Пример обработки кастомного события (перезагрузка страницы)
      BX.addCustomEvent(BX("block"), 'DEMOUpdate', function(){
         window.location.href = window.location.href;
      });
      */

      // Скрываем блок с результатом и процесс загрузки при загрузке страницы
      BX.hide(BX("block"));
      BX.hide(BX("process"));

      // Назначаем обработчик клика на элементы с классом 'css_ajax'
      BX.bindDelegate(
         document.body, 'click', {className: 'css_ajax' },
         function(e){
            if(!e)
               e = window.event;

            // Запускаем функцию загрузки данных
            DEMOLoad();
            // Отменяем стандартное поведение ссылки/кнопки
            return BX.PreventDefault(e);
         }
      );
   });
</script>

<!-- Кнопка, по нажатию на которую будет выполняться AJAX-запрос -->
<div class="css_ajax">click Me</div>

<?
// Подключаем эпилог ядра Bitrix (завершение работы страницы, вывод служебной информации)
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>