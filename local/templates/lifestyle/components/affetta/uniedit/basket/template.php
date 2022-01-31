<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('sale');
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
global $cont;
use Bitrix\Sale;
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

		// $rsStore = CCatalogStore::GetList(array('PRODUCT_ID'=>'ASC','ID' => 'ASC'),array('ACTIVE' => 'Y','PRODUCT_ID'=>$product, "TITLE"=>$shop["NAME"]),false,false,array("ID","TITLE","ACTIVE","PRODUCT_AMOUNT","ELEMENT_ID"));
		// while($Store=$rsStore->fetch())
		// {

		// 	if($Store["PRODUCT_AMOUNT"]>"0"){

		// 		$arrayexpress[] = $Store["ELEMENT_ID"];
		// 	}
		// }
	date_default_timezone_set("Europe/Moscow");
	$date = date('H:i');
	if($arParams["SHOPS"]){
		foreach($arParams["SHOPS"] as $shoplist){
			$activecity = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>IBLOCK_SHOPS, "ACTIVE"=>"Y", "XML_ID"=>$shoplist->shopID,"PROPERTY_CITY"=>trim($arParams["CITY"]), "<=PROPERTY_DELIVFROM"=>$date,  ">=PROPERTY_DELIVTO"=>$date), false, false, array("ID"))->GetNext();
			if($activecity["ID"]){
				$activearray = "Y";
			}
			if(!$activecity["ID"]){
				$activecity = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>IBLOCK_SHOPS, "ACTIVE"=>"Y", "XML_ID"=>$shoplist->shopID,"PROPERTY_CITY"=>trim($arParams["CITY"])), false, false, array("ID"))->GetNext();
				if($activecity["ID"]){
					//if ($USER->IsAdmin()){dump($activecity["ID"]);}	
					$shopsclosed = $cont["not_shop"];
				}
			}
		}
		if($activearray){
			$shopsclosed = false;
		}
	}
?>
<input type="hidden" class="delivhead" value="<?if($arParams["DELIV"]):?><?=$arParams["DELIV"];?><?elseif($arParams["SHOP"]):?><?=$arParams["SHOP"];?><?endif;?>">
<input type="hidden" class="cityhead" value="<?=$arParams["CITY"];?>">
<input type="hidden" class="priceapp" value="<?=$arParams["PRICE"];?>">
<input type="hidden" class="dcityshead" value="<?=$arParams["CITY_DELIV"];?>">
			<section class="section section-catalog">
				<div class="section-container">
						<?$APPLICATION->IncludeComponent(
							"bitrix:breadcrumb",
							"breadcrumbs",
							array(
								"PATH" => "",
								"SITE_ID" => "s1",
								"START_FROM" => "0",
								"COMPONENT_TEMPLATE" => "breadcrumbs"
							),
							false
						);?>
					<div class="section-header">
						<div class="section-title">
							<h1><?=$APPLICATION->ShowTitle(false);?></h1>
						</div>
						<div class="section-products-quantity"><?=array_sum($basket->getQuantityList());?> <?=pluralForm(array_sum($basket->getQuantityList()), "товар", "товара", "товаров");?></div>
					</div>
					<div class="section-content">
						<div class="cart cart-ajax__order">
							<?if(array_sum($basket->getQuantityList())>0):?>
								<?if($shopsclosed):?>
									<div class="cart-address submited">
										<div class="cart-address__title"><?=$shopsclosed;?></div>
									</div>
								<?endif;?>
								<?/*if($arParams["DELIV"]):?>
									<div class="cart-address submited">
										<div class="cart-address__title">Заказ будет доставлен по адресу:</div>
										<div class="cart-address__address"><?=$_SESSION["DELIV"];?></div>
										<div class="cart-address__change">
											<div class="link-icon"><a class="link-icon__text update_express">Изменить адрес</a></div>
										</div>
										
										<form method="post" data-action="/local/inc/ajax/cart_address.php" class="cart-address__form form" data-form="cart" data-redirect data-url="basket" data-form-no-ajax>
											<div class="form_row">
												<div class="form_group cart-field__city dropdown">
													<label class="form_label">
														<input class="form_input input--required" name="city" type="text" autocomplete="off" placeholder="Москва" value="<?=str_replace(",","",$arParams["CITY_DELIV"]);?>">
														<div class="link-icon cart-field-city__change">
															<div class="link-icon__icon">
																<svg class="icon icon-pen ">
																	<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/frontend/images/sprites.svg#pen"></use>
																</svg>
															</div><a class="link-icon__text">Изменить город</a>
														</div>
													</label>
													<?include($_SERVER['DOCUMENT_ROOT']."/local/inc/ajax/city.php");?>
												</div>
												<div class="form_group cart-field__street">
													<label class="form_label">
														<input class="form_input input--required" name="street" type="text" placeholder="Улица, дом" autocomplete="off">
													</label>
												</div>
												<div class="form_group cart-field__appartaments">
													<label class="form_label">
														<input class="form_input" name="flat" type="text" placeholder="Квартира" autocomplete="off">
													</label>
												</div>
												<div class="form_group cart-field__floor">
													<label class="form_label">
														<input class="form_input" name="floor" type="text" placeholder="Этаж" autocomplete="off">
													</label>
												</div>
												<div class="form_group cart-field__submit">
													<input class="form_input button button__color__red button__arrow inline" type="submit" value="">
												</div>
											</div>
										</form>
									</div>					
								<?else:?>
									<div class="cart-address">
										<div class="cart-address__title">Укажите адрес, от этого будет зависеть стоимость и срок доставки</div>
										<form method="post" data-action="/local/inc/ajax/cart_address.php" class="cart-address__form form" data-form="cart" data-url="basket" data-form-no-ajax>
											<div class="form_row">
												<div class="form_group cart-field__city dropdown">
													<label class="form_label">
														<input class="form_input input--required" name="city" type="text" placeholder="Москва" value="<?=str_replace(",","",$arParams["CITY_DELIV"]);?>">
														<div class="link-icon cart-field-city__change">
															<div class="link-icon__icon">
																<svg class="icon icon-pen ">
																	<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/frontend/images/sprites.svg#pen"></use>
																</svg>
															</div><a class="link-icon__text">Изменить город</a>
														</div>
													</label>
													<?include($_SERVER['DOCUMENT_ROOT']."/local/inc/ajax/city.php");?>
												</div>
												<div class="form_group cart-field__street">
													<label class="form_label">
														<input class="form_input input--required" name="street" type="text" placeholder="Улица, дом" autocomplete="off">
													</label>
												</div>
												<div class="form_group cart-field__appartaments">
													<label class="form_label">
														<input class="form_input" name="flat" type="text" placeholder="Квартира" autocomplete="off">
													</label>
												</div>
												<div class="form_group cart-field__floor">
													<label class="form_label">
														<input class="form_input" name="floor" type="text" placeholder="Этаж" autocomplete="off">
													</label>
												</div>
												<div class="form_group cart-field__submit">
													<input class="form_input button button__color__red button__arrow inline" type="submit" value="">
												</div>
											</div>
										</form>
									</div>
								<?endif;*/?>
								
									<form method="post" data-action="/local/inc/ajax/order.php" data-form="order" class="cart-address__form form" data-form-no-ajax>
									<input type="hidden" name="address" value="<?if($arParams["DELIV"]):?><?=$arParams["DELIV"];?><?endif;?>">
									<input type="hidden" class="deliv-active" value="<?=$arParams["DELIVERY"];?>">
									<input type="hidden" class="shops-active" value="<?=json_encode($arParams["SHOPS"]);?>">
									<input  name="city" type="hidden" value="<?=str_replace(",","",trim($arParams["CITY"]));?>">
										<div class="ajax-product">
											<?include($_SERVER['DOCUMENT_ROOT']."/local/inc/ajax/basket_prod.php");?>
										</div>
										<!--Если есть магазины в городе, выводим блок-->
										<?if(!$shopsclosed):?>
											<?if($onlinehop && $arParams["DELIV"] || $arParams["SHOP"]):?>
												<div class="cart-customer-form">
													<div class="form_row">
														<div class="form_col cart-customer__info">
															<div class="form_col__inner">
																<div class="form_title">Данные покупателя</div>												
																<div class="form_group">
																	<label class="form_label">
																		<input class="form_input input--required" name="name" type="text" placeholder="Имя" autocomplete="off">
																	</label>
																</div>
																<div class="form_group">
																	<label class="form_label">
																		<input class="form_input input--required" name="lastName" type="text" placeholder="Фамилия" autocomplete="off">
																	</label>
																</div>
																<div class="form_group">
																	<label class="form_label">
																		<input class="form_input input--required" type="text" name="email" placeholder="E-mail" autocomplete="off">
																	</label>
																</div>
																<div class="form_group">
																	<label class="form_label">
																		<input class="form_input input--required" type="text" name="phone" placeholder="+7 (xxx) xxx-xx-xx" autocomplete="off" data-inputmask="phone">
																	</label>
																</div>
															</div>
														</div>
														<div class="form_col cart-customer__comment">
															<div class="form_col__inner">
																<div class="form_title">Комментарии к заказу</div>
																<div class="form_group">
																	<label class="form_label">
																		<textarea class="form_textarea" name="USER_DESCRIPTION" placeholder="Ваш комментарий"></textarea>
																	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="form_row">
														<div class="form_col">
															<div class="form_col__inner">
																<div class="form_group">
																	<label class="form_label checkbox__label">
																		<input class="checkbox__input" name="checkbox" type="checkbox" checked="checked">
																		<div class="checkbox__emulator"></div>
																		<div class="checkbox__text"><span>Даю согласие на обработку</span> <a href="/licenses_detail/" target="_blank">персональных данных</a>
																		</div>
																	</label>
																</div>
																<div class="form_group form_submit">
																	<div class="form_group">
																		<input class="button button__arrow" type="submit"<?if(!$arParams["DELIV"]){echo" disabled";}?> value="Оформить заказ">
																	</div>
																</div>
																<?/*
																<div class="form_group promocode">
																	<label class="form_label">
																		<input class="form_input" type="text" name="cupon" placeholder="У вас есть промокод?">
																		<div class="form_input button button__arrow button__arrow__red inline promo"></div>
																	</label>
																</div>
																*/?>
															</div>
														</div>
													</div>
												</div>
											<?else:?>								
												<?if($arParams["DELIVERY"]=="ПАЛЫЧ-МАГ"):?>
													<div class="cart-address__title">Для завершения заказа необходимо выбрать магазин</div>
												<?elseif($arParams["DELIVERY"]=="ПАЛЫЧ-ЭКСПРЕСС"):?>
													<div class="cart-address__title">Для завершения заказа необходимо указать адрес доставки</div>
												<?endif;?>
											<?endif;?>
										<?endif;?>
									</form>

							<?else:?>
								<div class="cart-address submited">
									<div class="cart-address__title">Ваша корзина пуста</div>
									<div class="cart-address__change">
										Перейдите <a class="link-icon__text" href="/catalog/">в каталог</a> и наполните её
									</div>
								</div>								
							<?endif;?>
						</div>
					</div>
				</div>
			</section>
			<?if($onlinehop):?>
				<section class="section products-slider">
					<?global $basFilter;
					$basFilter['PROPERTY_BASKET_VALUE'] = "Y";
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"popular",
						Array(
							"DELIV" => $arParams["DELIV"],
							"DELIVERY" => $arParams["DELIVERY"],
							"SHOPS" => $arParams["SHOPS"],
							"SHOP" => $arParams["SHOP"],
							"CITY" => $arParams["city"],
							"idprice" => $arParams["idprice"],
							"oldprice" => $arParams["oldprice"],
							"CITY_DELIV" => $arParams["CITY_DELIV"],
							"ACTION_VARIABLE" => "action",
							"SLIDER_NAME" => "slider-buy-it",
							"SLIDER" => "Y",
							"TITLE" => "Не забудьте купить",
							"ADD_PICT_PROP" => "-",
							"ADD_PROPERTIES_TO_BASKET" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"ADD_TO_BASKET_ACTION" => "ADD",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "N",
							"BACKGROUND_IMAGE" => "-",
							"BASKET_URL" => "/personal/basket.php",
							"BROWSER_TITLE" => "-",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"COMPATIBLE_MODE" => "Y",
							"CONVERT_CURRENCY" => "N",
							"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
							"DETAIL_URL" => "",
							"DISABLE_INIT_JS_IN_COMPONENT" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"DISPLAY_COMPARE" => "N",
							"DISPLAY_TOP_PAGER" => "N",
							"ELEMENT_SORT_FIELD" => "sort",
							"ELEMENT_SORT_FIELD2" => "id",
							"ELEMENT_SORT_ORDER" => "asc",
							"ELEMENT_SORT_ORDER2" => "desc",
							"ENLARGE_PRODUCT" => "STRICT",
							"FILTER_NAME" => "basFilter",
							"HIDE_NOT_AVAILABLE" => "N",
							"HIDE_NOT_AVAILABLE_OFFERS" => "N",
							"IBLOCK_ID" => "4",
							"IBLOCK_TYPE" => "catalog",
							"INCLUDE_SUBSECTIONS" => "Y",
							"LABEL_PROP" => array(),
							"LAZY_LOAD" => "N",
							"LINE_ELEMENT_COUNT" => "3",
							"LOAD_ON_SCROLL" => "N",
							"MESSAGE_404" => "",
							"MESS_BTN_ADD_TO_BASKET" => "В корзину",
							"MESS_BTN_BUY" => "Купить",
							"MESS_BTN_DETAIL" => "Подробнее",
							"MESS_BTN_SUBSCRIBE" => "Подписаться",
							"MESS_NOT_AVAILABLE" => "Нет в наличии",
							"META_DESCRIPTION" => "-",
							"META_KEYWORDS" => "-",
							"OFFERS_LIMIT" => "5",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PAGER_TITLE" => "Товары",
							"PAGE_ELEMENT_COUNT" => "18",
							"PARTIAL_PRODUCT_PROPERTIES" => "N",
							"PRICE_CODE" => array(),
							"PRICE_VAT_INCLUDE" => "Y",
							"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
							"PRODUCT_ID_VARIABLE" => "id",
							"PRODUCT_PROPS_VARIABLE" => "prop",
							"PRODUCT_QUANTITY_VARIABLE" => "quantity",
							"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
							"PRODUCT_SUBSCRIPTION" => "Y",
							"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
							"RCM_TYPE" => "personal",
							"SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
							"SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
							"SECTION_ID_VARIABLE" => "SECTION_ID",
							"SECTION_URL" => "",
							"SECTION_USER_FIELDS" => array("",""),
							"SEF_MODE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "N",
							"SHOW_404" => "N",
							"SHOW_ALL_WO_SECTION" => "N",
							"SHOW_CLOSE_POPUP" => "N",
							"SHOW_DISCOUNT_PERCENT" => "N",
							"SHOW_FROM_SECTION" => "N",
							"SHOW_MAX_QUANTITY" => "N",
							"SHOW_OLD_PRICE" => "N",
							"SHOW_PRICE_COUNT" => "1",
							"SHOW_SLIDER" => "Y",
							"SLIDER_INTERVAL" => "3000",
							"SLIDER_PROGRESS" => "N",
							"TEMPLATE_THEME" => "blue",
							"USE_ENHANCED_ECOMMERCE" => "N",
							"USE_MAIN_ELEMENT_SECTION" => "N",
							"USE_PRICE_COUNT" => "N",
							"USE_PRODUCT_QUANTITY" => "N"
						)
					);?>
				</section>	
			<?endif;?>		