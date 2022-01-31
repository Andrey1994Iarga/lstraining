<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
if (!$USER->IsAuthorized()) {LocalRedirect("/auth/");}
?>	<?$APPLICATION->IncludeComponent(
    "affetta:uniedit",
    "index",
    Array(
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "COMPONENT_TEMPLATE" => "index"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>