<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Anggota Koperasi </label>
                            <div class="col-sm-9">
							<input type="text" id="anggota_koperasi" required name="anggota_koperasi" placeholder="Rp. 10.000" class="form-control" />
							<input type="hidden" id="anggota_koperasi_v"  name="anggota_koperasi_v"  />

							<script language="JavaScript">
                                        var rupiah4 = document.getElementById('anggota_koperasi');
                                        rupiah4.addEventListener('keyup', function(e) {
                                            rup4 = this.value.replace(/\D/g, '');
                                            $('#anggota_koperasi_v').val(rup4);
                                            rupiah4.value = formatRupiah4(this.value, 'Rp. ');
                                        });
                                        function formatRupiah4(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                split = number_string.split(','),
                                                sisa = split[0].length % 3,
                                                rupiah4 = split[0].substr(0, sisa),
                                                ribuan4 = split[0].substr(sisa).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan4) {
                                                separator = sisa ? '.' : '';
                                                rupiah4 += separator + ribuan4.join('.');
                                            }

                                            rupiah4 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah4;
                                            return prefix == undefined ? rupiah4 : (rupiah4 ? 'Rp. ' + rupiah4 : '');
                                        }
                            </script>
                            </div>
						</div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kas / Bon </label>
                            <div class="col-sm-9">
							<input type="text" id="tarif" required name="tarif" placeholder="kas / Bon" class="form-control" />
							<input type="hidden" id="tarif_v" required name="tarif_v"  />

							<script language="JavaScript">
                                        var rupiah5 = document.getElementById('tarif');
                                        rupiah5.addEventListener('keyup', function(e) {
                                            rup5 = this.value.replace(/\D/g, '');
                                            $('#tarif_v').val(rup5);
                                            rupiah5.value = formatRupiah5(this.value, 'Rp. ');
                                        });
                                        function formatRupiah5(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                split = number_string.split(','),
                                                sisa = split[0].length % 3,
                                                rupiah5 = split[0].substr(0, sisa),
                                                ribuan5 = split[0].substr(sisa).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan5) {
                                                separator = sisa ? '.' : '';
                                                rupiah5 += separator + ribuan5.join('.');
                                            }

                                            rupiah5 = split[1] != undefined ? rupiah5 + ',' + split[1] : rupiah5;
                                            return prefix == undefined ? rupiah5 : (rupiah5 ? 'Rp. ' + rupiah5 : '');
                                        }
                            </script>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ijin / Telat </label>
                            <div class="col-sm-9">
							<input type="text" id="ijin_telat" required name="ijin_telat" placeholder="Ijin Telat" class="form-control" />
							<input type="hidden" id="ijin_telat_v"  name="ijin_telat_v" />
							<script language="JavaScript">
                                        var rupiah6 = document.getElementById('ijin_telat');
                                        rupiah6.addEventListener('keyup', function(e) {
                                            rup6 = this.value.replace(/\D/g, '');
                                            $('#ijin_telat_v').val(rup6);
                                            rupiah6.value = formatRupiah6(this.value, 'Rp. ');
                                        });
                                        function formatRupiah6(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                split = number_string.split(','),
                                                sisa = split[0].length % 3,
                                                rupiah6 = split[0].substr(0, sisa),
                                                ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan6) {
                                                separator = sisa ? '.' : '';
                                                rupiah6 += separator + ribuan6.join('.');
                                            }

                                            rupiah6 = split[1] != undefined ? rupiah6 + ',' + split[1] : rupiah6;
                                            return prefix == undefined ? rupiah6 : (rupiah6 ? 'Rp. ' + rupiah6 : '');
                                        }
                            </script>
                            </div>
						</div>

						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> BMT </label>
                            <div class="col-sm-9">
							<input type="text" id="bmt" required name="bmt" placeholder="bmt" class="form-control" />
							<input type="hidden" id="bmt_v"  name="bmt_v" />

							<script language="JavaScript">
                                        var rupiah7 = document.getElementById('bmt');
                                        rupiah7.addEventListener('keyup', function(e) {
                                            rup7 = this.value.replace(/\D/g, '');
                                            $('#bmt_v').val(rup7);
                                            rupiah7.value = formatRupiah7(this.value, 'Rp. ');
                                        });
                                        function formatRupiah7(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                split = number_string.split(','),
                                                sisa = split[0].length % 3,
                                                rupiah7 = split[0].substr(0, sisa),
                                                ribuan7 = split[0].substr(sisa).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan7) {
                                                separator = sisa ? '.' : '';
                                                rupiah7 += separator + ribuan7.join('.');
                                            }

                                            rupiah7 = split[1] != undefined ? rupiah7 + ',' + split[1] : rupiah7;
                                            return prefix == undefined ? rupiah7 : (rupiah7 ? 'Rp. ' + rupiah7 : '');
                                        }
                            </script>
                            </div>
						</div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Di Inval </label>
                            <div class="col-sm-9">
							<input type="text" id="diinval" required name="diinval" placeholder="Di inval" class="form-control" />
							<input type="hidden" id="diinval_v"  name="diinval_v"  />
							
							<script language="JavaScript">
                                        var rupiah8 = document.getElementById('diinval');
                                        rupiah8.addEventListener('keyup', function(e) {
                                            rup8 = this.value.replace(/\D/g, '');
                                            $('#diinval_v').val(rup8);
                                            rupiah8.value = formatRupiah8(this.value, 'Rp. ');
                                        });
                                        function formatRupiah8(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                split = number_string.split(','),
                                                sisa = split[0].length % 3,
                                                rupiah8 = split[0].substr(0, sisa),
                                                ribuan8 = split[0].substr(sisa).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan8) {
                                                separator = sisa ? '.' : '';
                                                rupiah8 += separator + ribuan8.join('.');
                                            }

                                            rupiah8 = split[1] != undefined ? rupiah8 + ',' + split[1] : rupiah8;
                                            return prefix == undefined ? rupiah8 : (rupiah8 ? 'Rp. ' + rupiah8 : '');
                                        }
                            </script>
                            </div>
                        </div>