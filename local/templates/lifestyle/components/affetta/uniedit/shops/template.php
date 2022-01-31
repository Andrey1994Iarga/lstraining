<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$res = CIBlockElement::GetList(Array("NAME"=>"ASC"),Array("IBLOCK_ID"=>IBLOCK_SHOPS,"ACTIVE"=>"Y",array("LOGIC"=>"OR", "PROPERTY_CITY"=>$arParams["CITY"])),false,false,array("ID"));
	while($ob = $res -> Fetch())
	{

	    $VALUES = array();
	    $pro = CIBlockElement::GetProperty(IBLOCK_SHOPS, $ob["ID"], "sort", "asc", array("CODE" => "metro"));
	    while ($prop = $pro->GetNext())
	    {
	        $VALUES[] = $prop['VALUE'];
	    }
		$shopList[] = $ob;
		if($VALUES){$metroList[] = implode(',', $VALUES);}
	}

	$metros =array_unique(explode(",",implode(',', $metroList)));
	sort($metros);
?>
			<script>
			
			var currentCity="<?php echo($arParams["CITY"]); ?>";
			</script>
			
			<section class="section section-shops">
				<div class="section-container">
				
				<?php 
				if($arParams['IS_INDEX'])
				{
				?>
					<div class="section-header">
						<div class="section-title">
							<h2 class="h1">Фирменные магазины 
								<div class="link-icon dropdown"><a class="link-icon__text"><?=$arParams["CITY"];?></a>
									<div class="dropdown-block">
										<div class="dropdown-block__inner">
											<div class="dropdown-city">
												<div class="dropdown__heading">Ваш город</div>
												<form class="form-search dropdown-form">
													<div class="form_row">
														<div class="form_group">
															<label class="form_label">
																<input class="form_input form-search__input city__input" type="text" placeholder="Начните писать город" autocomplete="off">
																<div class="form-search__icon">
																	<button class="form-search__button" type="submit">
																		<svg class="icon icon-search-new ">
																			<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/frontend/images/sprites.svg#search-new"></use>
																		</svg>
																	</button>
																</div>
															</label>
														</div>
													</div>
													<div class="form_row dropdown-form-result tooltip_city scroll">
														<?include($_SERVER['DOCUMENT_ROOT']."/local/inc/ajax/cities.php");?>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</h2>
						</div>
						<div class="section-more"><a class="more-link" href="/shops/">Посмотреть все магазины
								<svg class="icon icon-arrow-more ">
									<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/frontend/images/sprites.svg#arrow-more"></use>
								</svg></a></div>
					</div>
					<?php
					}
					?>
				
					<div class="section-content">
						<div class="shops">
							<div class="shops-nav">
								<?if($metros):?>
									<div class="shops-search">
										<form class="form shops-search__form" action="">
											<div class="form_group">
												<label class="form_label">
													<div class="dropdown-select" data-dropdown="select">
														<input class="dropdown-select__value" type="hidden" value="">
														<div class="dropdown-select__label">
															<div class="dropdown-select__label__text">Выберите станцию метро</div>
														</div>
														<ul class="dropdown-select__list scroll">
															<li class="dropdown-select__item add_metro" data-value="">Все</li>
															<?foreach($metros as $inpmetro):?>
																<li class="dropdown-select__item add_metro" data-value="<?=$inpmetro;?>"><?=$inpmetro;?></li>
															<?endforeach;?>
														</ul>
													</div>
												</label>
											</div>
										</form>
									</div>
								<?endif;?>
								<div class="shops-nav__list">
									<div class="shops-nav__item" data-shops-nav="list">
										<div class="shops-nav__icon">
											<svg class="icon icon-menu ">
												<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/frontend/images/sprites.svg#menu"></use>
											</svg>
										</div>
										<div class="shops-nav__text">Список</div>
									</div>
									<div class="shops-nav__item" data-shops-nav="map">
										<div class="shops-nav__icon">
											<svg class="icon icon-geotag ">
												<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/frontend/images/sprites.svg#geotag"></use>
											</svg>
										</div>
										<div class="shops-nav__text">Карта</div>
									</div>
								</div>
							</div>
							<div class="shops-content">
								<div class="shops-content-tab shops-list scroll" data-shops-content="list">
									<?php
										if($shopList)
										{
											include($_SERVER['DOCUMENT_ROOT']."/local/inc/ajax/shoplist.php");
										}
										else
										{
											echo('<p>К сожалению, в этом городе нет наших магазинов</p>');
										}
										?>
								</div>
								<div class="shops-content-tab shops-map" data-shops-content="map">
									<div class="js-shop-map" id="map" data-map="shops" data-zoom="10" data-center="55.8617,38.1988" data-pin="<?=SITE_TEMPLATE_PATH;?>/frontend/images/map-pin.svg"></div>
									
									<?include($_SERVER['DOCUMENT_ROOT']."/local/inc/ajax/shoplistmap.php");?>
								</div>
								<div class="shops-content-tab shops-metro" data-shops-content="metro">3</div>
								<div class="shops-content-tab shops-beside" data-shops-content="beside">4</div>
							</div>
						</div>
					</div>
				</div>
			</section>