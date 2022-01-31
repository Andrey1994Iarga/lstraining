<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $cont;?>
					<div class="section-content">
						<div class="contacts">
							<div class="contacts-row">
								<div class="contacts-col">
									<form class="form" method="post" data-action="/local/inc/ajax/contacts.php" data-form="contacts" data-form-no-ajax>
										<div class="form_row">
											<div class="form_col">
												<div class="form_col__inner">
													<div class="form_title">Для жалоб и предложений</div>
													<div class="form_group">
														<label class="form_label">
															<input class="form_input input--required" type="text" name="name" autocomplete="off" placeholder="Имя">
														</label>
													</div>
													<div class="form_group">
														<label class="form_label">
															<input class="form_input input--required" type="text" name="phone" autocomplete="off" placeholder="+7 (xxx) xxx-xx-xx" data-inputmask="phone">
														</label>
													</div>
													<div class="form_group">
														<label class="form_label">
															<textarea class="form_textarea input--required" name="comment" autocomplete="off" placeholder="Ваш комментарий"></textarea>
														</label>
													</div>
													<div class="form_group">
														<label class="form_label checkbox__label">
															<input class="checkbox__input input--required" type="checkbox" name="subscribe_checkbox" checked="checked">
															<div class="checkbox__emulator"></div>
															<div class="checkbox__text"><span>Согласен(на)</span> <a href="" target="_blank">персональных данных</a>
															</div>
														</label>
													</div>
													<div class="form_group form_submit">
														<div class="form_group">
															<input class="button button__arrow" type="submit" value="Отправить">
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="contacts-col">
									<?if($cont["g_phone"]):?>
										<div class="contacts__tel">
											<a class="contacts__link" href="tel:<?=$cont["g_number"];?>"><?=$cont["g_phone"];?></a>
											<a class="link-icon">
												<div class="link-icon__icon">
													<svg class="icon icon-tel ">
														<use xlink:href="<?=SITE_TEMPLATE_PATH;?>/frontend/images/sprites.svg#tel"></use>
													</svg>
												</div>
												<div class="link-icon__text"><?=$cont["g_name"];?></div>
											</a>
										</div>
									<?endif;?>
									<?if($cont["mail"]):?>
										<div class="contacts__email">
											<div class="contacts__text">Или напишите нам на почту</div>
											<a class="contacts__link" href="mailto:<?=$cont["mail"];?>"><?=$cont["mail"];?></a>
										</div>
									<?endif;?>
								</div>
							</div>
						</div>
					</div>
