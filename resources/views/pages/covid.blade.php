        @extends('layouts.general')

        @section('content')
            <div class="calculator__block bg-grey entry agentBlock" id="section1">
                <div class=""></div>
                <h3 class="calculator__title">
                    Личные данные</h3>
                <div class="grid">
                    <div id="ajax"></div>


                    <!-- ИИН -->
                    <form action="#" method="POST" id="">

                        @csrf


                        <div class="grid">
                            <div id="ajax"></div>

                            <!-- ИИН -->
                            <div class="col--12-12">
                            <fieldset class="field-set col col--6-12" style="false">
                                <label for="orderIIN" class="field-set__label checkList">
                                    ИИН <span style="display: none;">(при наличии)</span>
                                </label>
                                <input class="field field datas iins"   id="iin"
                                       type="" name="iin" maxlength="12" onchange="load_iin()">
                            </fieldset>
                            </div>
                            <!-- Имя -->

                            <fieldset class="field-set col col--3-12" style="false">
                                <label for="orderFIRST_NAME" class="field-set__label checkList">
                                    Имя					</label>
                                <input class="field datas keyboardInput agentData1" type="text"
                                       name="First_Name" id="First_Name" value="">
                            </fieldset>

                            <!-- Фамилия -->
                            <fieldset class="field-set col col--3-12 " style="false">
                                <label for="orderLAST_NAME" class="field-set__label checkList">
                                    Фамилия					</label>
                                <input class="field datas keyboardInput agentData1" type="text"
                                       name="Last_Name" id="Last_Name" value="">
                                <div class="small col keyboardInput">
                                    <span class="error" id="checkLastName1"></span></div>
                            </fieldset>

                            <!-- Отчество -->

                            <fieldset class="field-set col col--3-12" style="false">
                                <label for="orderMIDDLE_NAME" class="field-set__label checkList">
                                    Отчество</label>
                                <input class="field datas keyboardInput agentData1" type="text"
                                       name="Patronymic_Name" id="Patronymic_Name" value="">
                            </fieldset>

                            <!-- ДР -->
                            <fieldset class="field-set col col--3-12" style="false">
                                <label for="orderDocDate" class="field-set__label checkList">
                                    День рождение				</label>
                                <input class="field field--date datas edate" id="Born" type="tel"
                                       name="Born" maxlength="10" placeholder="dd.mm.yyyy" value="" autocomplete="off">
                            </fieldset>



                            <!--  Номер документа	 -->

                            <fieldset class="field-set col col--4-12" style="false">
                                <label for="orderDocNumber" class="field-set__label checkList">
                                    Номер документа					</label>
                                <input class="field field-- datas" id="DOCUMENT_NUMBER" type="text"
                                       name="DOCUMENT_NUMBER" value="">
                                <div class="small col" id="checkDocNumber1"></div>
                            </fieldset>


                            <!-- Дата выдачи документа -->

                            <fieldset class="field-set col col--4-12" style="false">
                                <label for="orderDocDate" class="field-set__label checkList">
                                    Дата выдачи документа</label>
                                <input class="field field--date datas edate" id="DOCUMENT_GIVED_DATE" type="tel"
                                       name="DOCUMENT_GIVED_DATE" maxlength="10" placeholder="dd.mm.yyyy" value="" autocomplete="off">
                            </fieldset>

                            <!-- Кем выдан	 -->

                            <fieldset class="field-set col col--4-12" style="false">
                                <label for="orderDocDate" class="field-set__label checkList">
                                    Кем выдан				</label>
                                <input class="field datas keyboardInput agentData1" id="docDate1" type="text"
                                       name="docDate[]" maxlength="10"  value="" autocomplete="off">
                            </fieldset>


                        </div>



                        <div class="grid">
                            <fieldset class="field-set col col--4-12">
                                <label class="field-set__label"></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="insured[]" id="insured1" value="yes" class="datas agentData1">
                                    <span class="checkbox__label">Застрахованный является Страхователем</span>
                                </label>
                            </fieldset>

                            <fieldset class="field-set col col--6-12">
                                <label class="field-set__label"></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="insured[]" id="insured1" value="no" class="datas agentData1">
                                    <span class="checkbox__label">Застрахованный  НЕ является  резидентом США/Гражданином США</span>
                                </label>
                            </fieldset>
                        </div>


                <div class="grid">

                    <!-- Мобильный номер -->
                    <fieldset class="field-set col col--6-12">
                        <label for="orderPhone" class="field-set__label checkList">
                            Мобильный телефон					</label>
                        <input type="tel" class="field interTel datas phone_number" id="Phone" name="Phone" value="">
                    </fieldset>

                    <!-- E-Mail -->
                    <fieldset class="field-set col col--6-12">
                        <label for="orderEmail" class="field-set__label checkList">
                            E-Mail					</label>
                        <input type="text" class="field datas keyboardInput agentData1" id="Email" name="Email" value="">
                        <div class="small col" id="checkEmail1"></div>
                    </fieldset>


                    <fieldset class="field-set col col--6-12">
                        <label for="orderEmail" class="field-set__label checkList">
                        Страховая сумма</label>
                        <input type="text" class="field datas keyboardInput agentData1" id="Calc_Sum" name="Calc_Sum" value="">
                        <div class="small col" id="checkEmail1"></div>
                        <p class="small text-grey">Период страхования - 12 месяцев</p>
                    </fieldset>

                </div>
                            <h3 class="calculator__title">Анкета</h3>

                            <div class="grid">

                                <div class="col-50 col col--6-12">
                                    <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcPlus" class="checkbox">
									<input type="checkbox" name="calcPlus" value="yes" id="calcPlus" class="new-styler">
									<span class="checkbox__label">Имеет ли Застрахованный инвалидность?</span>
								</label>
							</h5>
						</span>
                                    </div>

                                </div>

                                <div class="col-50 col col--6-12">
                                    <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcCareless" class="checkbox">
									<input type="checkbox" name="calcCareless" value="yes" id="calcCareless" class="new-styler">
									<span class="checkbox__label">Состоит ли Застрахованный на учете в психоневрологическом диспансере?</span>
								</label>
							</h5>
						</span>
                                    </div>
                                </div>

                                <div class="col-50 col col--6-12">
                                    <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcPeople" class="checkbox">
									<input type="checkbox" name="calcPeople" value="yes" id="calcPeople" class="new-styler">
									<span class="checkbox__label">Занимается ли Застрахованный спортом?</span>
								</label>
							</h5>
						</span>
                                    </div>
                                </div>

                                <div class="col-50 col col--6-12">
                                    <div class="checkbox-enhanced">
						<span>
							<h5>
								<label for="calcGPO" class="checkbox">
									<input type="checkbox" name="calcGPO" value="yes" id="calcGPO" class="new-styler">
									<span class="checkbox__label">Имеет ли Застрахованный хронические или наследственные заболевания?</span>
								</label>
							</h5>
						</span>

                                    </div>
                                </div>
                                <fieldset class="field-set col col--4-12">
                                    <br><button type="submit" class="button button--hollow agentClear" id="save">Save</button>
                                </fieldset>
                            </div>
                    </form>
                </div>
            </div>




            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://unpkg.com/imask"></script>
            <script type="text/javascript">


            $(document).ready(function() {
                $('.edate').datepicker({
                    dateFormat: "dd.mm.yyyy"
                });
                $('.edate').val("");

                var input = document.querySelectorAll('.edate');
                var dateInputMask = function dateInputMask(elm) {
                    elm.addEventListener('keypress', function(e) {
                        if(e.keyCode < 47 || e.keyCode > 57) {
                            e.preventDefault();
                        }

                        var len = elm.value.length;

                        // If we're at a particular place, let the user type the slash
                        // i.e., 12/12/1212
                        if(len !== 1 || len !== 3) {
                            if(e.keyCode == 47) {
                                e.preventDefault();
                            }
                        }

                        // If they don't add the slash, do it for them...
                        if(len === 2) {
                            elm.value += '.';
                        }

                        // If they don't add the slash, do it for them...
                        if(len === 5) {
                            elm.value += '.';
                        }
                    });
                };
                for(var j=0; j < 2; j++){
                    dateInputMask(input[j]);
                }

            });

            var phoneMask = IMask(
                document.getElementById('Phone'), {
                    mask: '+{7}(000)000-00-00'
                });6

            document.oninput = function() {
                var input = document.querySelector('.iins');
                input.value = input.value.replace (/\D/g, '');
            }

            $(".iins").on('keypress change', function load_iin() {
              var iin = $("#iin").val();
              if(iin.length == 12) {
                  var Last_Name = $("#Last_Name").val();
                  var First_Name = $("#First_Name").val();
                  var Patronymic_Name = $("#Patronymic_Name").val();
                  var Born = $("#Born").val();
                  var DOCUMENT_GIVED_DATE = $("#DOCUMENT_GIVED_DATE").val();
                  var DOCUMENT_NUMBER = $("#DOCUMENT_NUMBER").val();
                  var Email = $("#Email").val();
                  var Phone = $("#Phone").val();
                  var Calc_Sum = $("#Calc_Sum").val();

                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type: 'POST',
                      url: "{{ route('ajaxRequest.post') }}",
                      data: {
                          iin: iin
                      },
                      success: function (data) {
                          if (data.code == 200) {
                              $("#Last_Name").val(data.Last_Name)
                              $("#First_Name").val(data.First_Name)
                              $("#Patronymic_Name").val(data.Patronymic_Name)
                              $("#Born").val(data.Born)
                              $("#DOCUMENT_GIVED_DATE").val(data.DOCUMENT_GIVED_DATE)
                              $("#DOCUMENT_NUMBER").val(data.DOCUMENT_NUMBER)
                          }
                      }
                  });
              }
          });

    </script>



            <style>
                .removejust {
                    display: none;
                }

                section.nav-section {
                    display: none;
                }

                .card-body {
                    display: none;
                }
            </style>
            </div>
            <!-- .grid -->
            </section>
            <!-- .content -->
            </div>
            <!-- .contacts -->
            </div>
            <!-- end container -->
            </main>
            <!-- end main -->


        @endsection



