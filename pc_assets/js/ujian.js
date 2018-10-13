function ListSoal(id_group = null,id_ujian = null)
	{
		$.ajax({
			url : 'ajax.php?m=soal&id_group='+id_group+'&id_ujian='+id_ujian,
			success:function(e)
			{
			 console.log(e);	
			}
		})
	}


function GetSoal(id_soal,no_urut,id_siswa,id_ujian = null,id_group = null)
{
	$.ajax({
		url : 'ajax.php?m=get_soal&id_soal='+id_soal+'&no_urut='+no_urut+'&id_siswa='+id_siswa+'&id_ujian='+id_ujian+'&id_group='+id_group,
		success:function(data)
		{
			$('#no_urut').html(no_urut);
			$('#soal_area').html(data);
		}
	});

	cek_sudah_jawab(id_soal,id_siswa);
	des_text(id_ujian,id_group,id_soal);
	mapel_text(id_ujian,id_group,id_soal);
}

function JmlSoal(id_group = null,id_ujian = null)
	{
		$.ajax({
			url : 'ajax.php?m=jml_soal&id_group='+id_group+'&id_ujian='+id_ujian,
			success:function(e)
			{
			 $('#jml_soal').html(e);
			}
		})
	}

function JawabSoal(id_soal,id_siswa,id_ujian = null,id_group = null,jawaban)
{
	$.ajax({
		url : 'ajax.php?m=jawab_soal&id_group='+id_group+'&id_ujian='+id_ujian+'&id_siswa='+id_siswa+'&id_soal='+id_soal+'&jawaban='+jawaban,
		success:function(data)
		{
			var id ='#'+jawaban+id_soal;
			
			if(jawaban == 'A')
			{
				$(id).attr('class','set col-1 align-center spacer-1 bg-success text-white');
				$('#B'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#C'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#D'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#E'+id_soal).attr('class','set col-1 align-center spacer-1');

			}else if(jawaban == 'B')
			{
				$('#A'+id_soal).attr('class','set col-1 align-center spacer-1');
				$(id).attr('class','set col-1 align-center spacer-1 bg-success text-white');
				$('#C'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#D'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#E'+id_soal).attr('class','set col-1 align-center spacer-1');
			}else if(jawaban == 'C')
			{
				$('#A'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#B'+id_soal).attr('class','set col-1 align-center spacer-1');
				$(id).attr('class','set col-1 align-center spacer-1 bg-success text-white');
				$('#D'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#E'+id_soal).attr('class','set col-1 align-center spacer-1');
			}else if(jawaban == 'D')
			{
				$('#A'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#B'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#C'+id_soal).attr('class','set col-1 align-center spacer-1');
				$(id).attr('class','set col-1 align-center spacer-1 bg-success text-white');
				$('#E'+id_soal).attr('class','set col-1 align-center spacer-1');
			}else if(jawaban == 'E')
			{
				$('#A'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#B'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#C'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#D'+id_soal).attr('class','set col-1 align-center spacer-1');
				$(id).attr('class','set col-1 align-center spacer-1 bg-success text-white');

			}else{
				$('#A'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#B'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#C'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#D'+id_soal).attr('class','set col-1 align-center spacer-1');
				$('#E'+id_soal).attr('class','set col-1 align-center spacer-1');
			}
				$('#answer'+id_soal).html(jawaban);
				$('#bnum'+id_soal).attr('class','btn success medium');
		}
	});

	soal_dijawab(id_ujian,id_group,id_siswa);
	soal_belum_dijawab(id_ujian,id_group,id_siswa);
}

function lewati_soal(id_soal,id_siswa,no_urut,id_ujian = null,id_group = null,btn = 'danger')
{
	$.ajax({
		url : 'ajax.php?m=lewati_soal&id_group='+id_group+'&id_soal='+id_soal+'&id_ujian='+id_ujian,
		success:function(data)
		{
			GetSoal(data,no_urut+1,id_siswa,id_ujian,id_group);
			//alert(data+' x '+id_soal);
			$('#bnum'+id_soal).attr('class','btn '+btn+' medium');
		}
	})
}

function simpan_lanjutkan(id_soal,id_siswa,no_urut,id_ujian=null,id_group=null)
{

	$.ajax({
		url : 'ajax.php?m=simpan_lanjutkan&id_soal='+id_soal+'&id_siswa='+id_siswa+'&id_ujian='+id_ujian+'&id_group='+id_group,
		success:function(data)
		{
			if(data == 'ok')
			{

				lewati_soal(id_soal,id_siswa,no_urut,id_ujian,id_group,'success');
			}else{
				alert('Soal belum di jawab ');
				return false;
			}
		}
	});
}

function hapus_jawaban(id_soal,id_siswa,no_urut,id_ujian = null,id_group = null)
{
	$.ajax({
		url : 'ajax.php?m=hapus_jawaban&id_soal='+id_soal+'&id_siswa='+id_siswa+'&id_ujian='+id_ujian+'&id_group='+id_group,
		success:function(data)
		{
			alert(data);
		}
	})
}

function update_waktu(waktu,id_ujian=null,id_group=null,id_siswa)
{
  $.ajax({
    type : 'GET',
    url :'ajax.php?m=update_waktu&id_ujian='+id_ujian+'&id_group='+id_group+'&id_siswa='+id_siswa+'&waktu='+waktu,
    success:function(data)
    {
      if(data == 'ok'){
      console.log('success update_waktu');
      }
    }
  });
}
function startTimer(duration,id_ujian=null,id_group=null,id_siswa) {
    var timer = duration, minutes, seconds;
    var x = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById('waktu').textContent = minutes + ":" + seconds;
        if((timer % 60) === 0)
        {
          update_waktu(minutes,id_ujian,id_group,id_siswa);
        }
        if (--timer < 0) {
            clearInterval(x);
            document.getElementById('waktu').textContent = 'Waktu habis!';
            alert('Waktu habis !');
            window.location.href='./?p=nilai&id_ujian='+id_ujian+'&id_group='+id_group+'&id_soal='+id_siswa;
        }
    }, 1000);
}

function soal_dijawab(id_ujian = null,id_group = null,id_siswa)
{
	$.ajax({
		url :'ajax.php?m=soal_dijawab&id_ujian='+id_ujian+'&id_group='+id_group+'&id_siswa='+id_siswa,
		success:function(data)
		{
			$("#soal_dijawab").html(data);
		}
	});
}

function soal_belum_dijawab(id_ujian = null,id_group = null,id_siswa)
{
	$.ajax({
		url :'ajax.php?m=soal_belum_dijawab&id_ujian='+id_ujian+'&id_group='+id_group+'&id_siswa='+id_siswa,
		success:function(data)
		{
			$("#soal_belum_dijawab").html(data);
		}
	});
}

function cek_sudah_jawab(id_soal,id_siswa)
{
	$.ajax({
		url: 'ajax.php?m=cek_sudah_jawab&id_soal='+id_soal+'&id_siswa='+id_siswa,
		success:function(data)
		{
			if(data !== "belum"){

			$('#answer'+id_soal).html(data);
			$('#bnum'+id_soal).attr('class','btn success medium');

			}
			/*$('html').html(data);*/
		}
	});
}

function selesai_ujian(id_group=null,id_ujian=null,id_siswa)
{
	$.ajax({
		url :'ajax.php?m=soal_belum_dijawab&id_ujian='+id_ujian+'&id_group='+id_group+'&id_siswa='+id_siswa,
		success:function(data)
		{
	
			if(data != 0 || data == "")
			{
			var x = confirm(data +' Soal belum terjawab, apakah anda yakin ?');
			if(x === true){
			window.location.href='?p=nilai&id_ujian='+id_ujian+'&id_group='+id_group+'&id_siswa='+id_siswa;
			}else{
			return false;
			}
			
			}else{
				alert('Anda sudah menyelesaikan semua soal, klik OK untuk melanjutkan !');
			window.location.href='?p=nilai&id_ujian='+id_ujian+'&id_group='+id_group+'&id_siswa='+id_siswa;

			}
		}
	});


}

function resize_font(size)
{
	$('#soal_area').css('font-size',size);
}

function des_text(id_ujian=null,id_group=null,id_soal)
{
	$.ajax({
		url : 'ajax.php?m=des_text&id_ujian='+id_ujian+'&id_group='+id_group+'&id_soal='+id_soal,
		success:function(e)
		{
			$('#des_text').html(e);
		}
	});
}
function mapel_text(id_ujian=null,id_group = null,id_soal)
{
	$.ajax({
		url : 'ajax.php?m=mapel_text&id_ujian='+id_ujian+'&id_group='+id_group+'&id_soal='+id_soal,
		success:function(e)
		{
			$('#mapel_text').html(e);
		}
	});
}