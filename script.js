function setCookie (name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape(value) +
    ((expires) ? "; expires=" + expires : "") +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    ((secure) ? "; secure" : "");
}

// Оставлено для совместимости, не трогать!
function toggle_visibility(id) {jQuery('#'+id).toggle();}

function getCookie(name) {
    var cookie = " " + document.cookie, search = " " + name + "=", setStr = null, offset = 0, end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1)
                end = cookie.length;
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return(setStr);
}

// Смена темы старая/новая
function neworold() {
	var variant = getCookie('theme_variant'); // читаем куку в переменную
	if (variant==null) {
		date = new Date();
		date.setTime(date.getTime()+(1000*2678400));
		var expiration = date.toGMTString();
		setCookie('theme_variant', 'old', expiration,'/');
		jQuery('body').addClass('old');
	}
	else if (variant=='new') {
		date = new Date();
		date.setTime(date.getTime()+(1000*2678400));
		var expiration = date.toGMTString();
		setCookie('theme_variant', 'old', expiration,'/');
		jQuery('body').removeClass('new');
		jQuery('body').addClass('old');
		jQuery('#thsw').text('Новая тема');
	}
    else {
		date = new Date();
		date.setTime(date.getTime()+(1000*2678400));
		var expiration = date.toGMTString();
		setCookie('theme_variant', 'new', expiration,'/');
		jQuery('body').removeClass('old');
		jQuery('body').addClass('new');
		jQuery('#thsw').text('Старая тема');
    }
}
function checkold () {
	var variantcheck = getCookie('theme_variant'); // читаем куку в переменную
	if (variantcheck=='new') {
		jQuery('body').addClass('new');
	}
    else if (variantcheck=='old') {
		jQuery('body').addClass('old');
    }
}

// Сменя дня/ночи
function dayornight() {
	var daynite = getCookie('hide_dayornight'); // читаем куку в переменную
	if (daynite==null) {
		date = new Date();
		date.setTime(date.getTime()+(1000*2678400));
		var expiration = date.toGMTString();
		setCookie('hide_dayornight', 'night', expiration,'/');
		jQuery('body').addClass('night');
	}
	else if (daynite=='day') {
		date = new Date();
		date.setTime(date.getTime()+(1000*2678400));
		var expiration = date.toGMTString();
		setCookie('hide_dayornight', 'night', expiration,'/');
		jQuery('body').removeClass('day');
		jQuery('body').addClass('night');
	}
    else {
		date = new Date();
		date.setTime(date.getTime()+(1000*2678400));
		var expiration = date.toGMTString();
		setCookie('hide_dayornight', 'day', expiration,'/');
		jQuery('body').removeClass('night');
		jQuery('body').addClass('day');
    }
}
function checknight () {
	var daynitecheck = getCookie('hide_dayornight'); // читаем куку в переменную
	if (daynitecheck=='day') {
		jQuery('body').addClass('day');
	}
    else if (daynitecheck=='night') {
		jQuery('body').addClass('night');
    }
}

function fr_hideconfig(value)
{
    var don = getCookie('hide_dayornight');
    if(don==null) don='day';
    if(value==null) value='show';
    if(value=='hide') {
            jQuery('.gallery').hide();
            jQuery('.gallery').addClass('hide');
            jQuery('#hideponysp').text('Показать пони');
        } else {
            jQuery('.gallery').show();
            jQuery('.gallery').removeClass('hide');
            jQuery('#hideponysp').text('Спрятать пони');
   }
}

function fr_hideconfig_set() {
    var cook = getCookie('hide_manage');
    if(cook == 'hide')  cook = 'show'
    else    cook = 'hide';
	date = new Date();
	date.setTime(date.getTime()+(1000*2678400));
	var expiration = date.toGMTString();
    setCookie('hide_manage', cook, expiration,'/');
    fr_hideconfig(cook);
    return false;
}

function rselectbyclass(sclass) {
    if(sclass==null)
        sclass=false;
    jQuery('.large').children().each(function(){
        jQuery(this).show();
    });
    if(sclass) {
        jQuery('.large').children().each(function(){
            jQuery(this).hide();
        });
        jQuery('.large').children('.'+sclass).each(function(){
            jQuery(this).show();
        })
   }
}


function gallery() {
	var galrotate = getCookie('gallery_rotate'); // читаем куку в переменную
	if ( galrotate==null ) { // если куки нет
	var theRandom = Math.round(Math.random()*authorlinks.length); // генерим рандом из массива
	var date = new Date();
	date.setTime(date.getTime()+(10800*1000));
	var expiration = date.toGMTString();
	setCookie('gallery_rotate', theRandom, expiration, '/'); // просто генерим куку на 3 часа
	jQuery('.sourcelink').attr('href', authorlinks[theRandom] ); // ставит нужный URL в href ссылки на автора из массива ссылок
	jQuery('.artwork').attr('src', '//test-ep.alterpony.ru/main/headers/art-' + theRandom + '.jpg'); // ставит картинке src нужного вида на основании цифры
	}
	else { //если кука есть, читаем, какую картинку надо грузить и грузим
	jQuery('.sourcelink').attr('href', authorlinks[galrotate] ); // ставит нужный URL из куки в href
	jQuery('.artwork').attr('src', '//test-ep.alterpony.ru/main/headers/art-' + galrotate + '.jpg'); // ставит картинке src из куки
	}
}

function toggle_visibility2(id,page) {
    if(jQuery('#'+id).html()<=5) {
        jQuery('#'+id).load('/txt/'+page+'.txt');
    }
    var e = document.getElementById(id);
    if(e.style.display == 'block')  e.style.display = 'none';
    else    e.style.display = 'block';
}

// Orhideous
function activate_player() {
    jQuery(".listen").click(function() {
			var m_span = jQuery(this).parent();
			if (jQuery(this).parent().parent().children('#player')[0]) {
				jQuery('#player').slideToggle().remove();				
				}
			else {
			var m_link = m_span.children('.download').attr('href');
			var m_code = '<div id="player" style="display: none;"><embed type="application/x-shockwave-flash" src="//files.everypony.ru/games/dewplayer-vol.swf" width="100%" height="20" flashvars="mp3='+m_link+'"></div>'
			m_span.after(m_code);
			jQuery('#player').slideToggle();
			}
    });
}

function activate_spoiler_old() {
	jQuery("a.spoiler").click(function(){
		jQuery('div#'+jQuery(this).attr('id')).slideToggle();
	});
}
function activate_spoiler() {
        jQuery("a.spoiler").click(function(){
		tag = jQuery('a.spoiler').attr('id');
		jQuery('div.spoiler[title="'+tag+'"]').slideToggle();
        });
}


// OnLoad
jQuery(function() {
	jQuery('.header-pony').html(ponywords[Math.round(Math.random()*ponywords.length)]);
	fr_hideconfig(getCookie('hide_manage'));
	gallery();
	checknight();
	checkold();
	activate_player();
	activate_spoiler();
	activate_spoiler_old();
	startTimer();// До следующего сезона.
	//jQuery('#time-header').html('<span>Новый сезон:</span>Обязательно будет');
	//jQuery("#tabs").tabs();
});


ponywords = [
'Дерпи не грустит<br> и ты не грусти.  ',
'Пони в каждый дом.',
'Брони всех стран,<br/> объединяйтесь.',
'Дружба — магия,<br/> пони — милашки.',
'Derpy.<br/> Connecting ponies.',
'Следуй за белой пони.',
'Everypony.ru теперь на 20% круче.',
'Пони расслабляют ум и снимают стресс.',
'Капля великого<br/> в каждой пони.',
'Пони исцеляют душу,<br/> очищают карму.',
'Будущее<br/> принадлежит пони.',
'Ответ прост:<br/> нужно стать пони.',
'Принцесса Луна — <br/>великий миротворец.',
'Пони — это жизнь!',
'Пони — это пони!',
'Пони — цветы жизни.',
"♪ Do you know you're all<br/> my very best friends ♪",
'♪ So quietly and nice ♪',
"♪ Hush now, quiet now<br/> It's time to go to bed ♪",
'♪ You gotta share<br/> You gotta care ♪ ',
"♪ She's evil enchantress<br/> She does evil dances ♪",
'♪ The time has come<br/> to welcome spring ♪',
'Eeyup!',
'Yay!',
'Дорогая принцесса Селестия...',
'Читай книги. Будешь умной как Твайлайт.',
'Читай книги. Будешь умным как Твайлайт.',
'Зима прошла, настало лето. Cпасибо, пони, вам за это!',
'Будь пони и пони к тебе потянутся.',
'PonyCola.<br/>Always ask for more.',
'Не корми параспрайтов.<br> Защити Эквестрию.',
'В здоровой пони здоровый дух.',
'Селестия любит тебя несмотря ни на что.',
'Понификация страны. Пятилетку за три года.',
'Понифицировал себя, понифицируй друга.',
'10 тысяч тонн дружбы.',
'Лучей добра тебе, поняша!',
'Из открытого окна<br/> мне Эквестрия видна.',
'Пони - пегас,<br/> пока не погас.',
'Пони разные важны,<br/> пони разные нужны.',
'<a style="text-decoration:underline;" href="http://derpy.fr/yp.html">Стань одним из нас</a>.',
'Ты ведь не будешь тут хулиганить?',
'Поклонись своей Принцессе!',
'Поняша, как-нибудь сходи в планетарий!',
'Поняша, а ты давно гулял на улице?',
'Я вовсе не грустная! Я задумалась...',
'Раньше я любила балы...',
'Поняша, потанцуем?',
'А вчера ко мне заходили меткоискатели.',
'<a style="text-decoration:underline;" href="http://stories.everypony.ru/">Поняша, не хочешь почитать?</a>',
'А ночью снова считать звёзды...',
'Трудно быть Принцессой.',
'Селестия хочет в отпуск, я знаю!',
'В горах звёздное небо красивее.',
'А ещё я умею делать полярное сияние!',
'Поняша, а ты бы хотел стать моим паладином?',
'Селестия спрятала мой абак!',
'В детстве я любила прятки.',
'О чём ты мечтаешь, поняша?',
'Что-то я устала за ночь...',
'Сон - важная часть для здоровья пони!',
'Поняша, ты же поделишься кексиком?',
'Напишешь для меня стишок?',
'Ничего, у нас ещё всё впереди!',
'Надо бы сходить погулять...',
'А ты любишь ночь, поняша?',
'Иногда мне кажется, что я говорю сама с собой...',
];

authorlinks = [
    'http://gign-3208.deviantart.com', //0
    'http://gign-3208.deviantart.com', //1
    'http://gign-3208.deviantart.com', //2
    'http://cannibalus.deviantart.com',//3
    'http://cannibalus.deviantart.com',//4
    'http://rainihorn.deviantart.com',//5
    'http://rainihorn.deviantart.com',//6
    'http://ruhisu.deviantart.com',//7
    'http://ruhisu.deviantart.com',//8
    'http://ruhisu.deviantart.com',//9
   // 'http://svetka2306.deviantart.com'//10
];


var ponycountdowndates=new Array();
// http://javascript.ru/Date.UTC
// ponycountdowndates[0]  = new Date((Date.UTC(2016,  2, 26, 15, 00))); // s06 e01
// ponycountdowndates[1]  = new Date((Date.UTC(2016,  2, 26, 15, 30))); // s06 e02
// ponycountdowndates[2]  = new Date((Date.UTC(2016,  3,  2, 15, 30))); // s06 e03
// ponycountdowndates[3]  = new Date((Date.UTC(2016,  3,  9, 15, 30))); // s06 e04
// ponycountdowndates[4]  = new Date((Date.UTC(2016,  3, 16, 15, 30))); // s06 e05
// ponycountdowndates[5]  = new Date((Date.UTC(2016,  3, 30, 15, 30))); // s06 e06
// ponycountdowndates[6]  = new Date((Date.UTC(2016,  4,  7, 15, 30))); // s06 e07
// ponycountdowndates[7]  = new Date((Date.UTC(2016,  4, 14, 15, 30))); // s06 e08
// ponycountdowndates[8]  = new Date((Date.UTC(2016,  4, 21, 15, 30))); // s06 e09
// ponycountdowndates[9]  = new Date((Date.UTC(2016,  4, 28, 15, 30))); // s06 e10
// ponycountdowndates[10] = new Date((Date.UTC(2016,  5,  4, 15, 30))); // s06 e11
// ponycountdowndates[11] = new Date((Date.UTC(2016,  5, 18, 15, 30))); // s06 e12
// ponycountdowndates[12] = new Date((Date.UTC(2016,  5, 25, 15, 30))); // s06 e13
// ponycountdowndates[13] = new Date((Date.UTC(2016,  6,  2, 15, 30))); // s06 e14
// ponycountdowndates[14] = new Date((Date.UTC(2016,  6,  9, 15, 30))); // s06 e15

ponycountdowndates[15] = new Date((Date.UTC(2016,  7, 27, 15, 30))); // s06 e16
ponycountdowndates[16] = new Date((Date.UTC(2016,  8,  3, 15, 30))); // s06 e17
ponycountdowndates[17] = new Date((Date.UTC(2016,  8, 10, 15, 30))); // s06 e18
ponycountdowndates[18] = new Date((Date.UTC(2016,  8, 17, 15, 30))); // s06 e19
ponycountdowndates[19] = new Date((Date.UTC(2016,  8, 24, 15, 30))); // s06 e20
ponycountdowndates[20] = new Date((Date.UTC(2016,  9,  1, 15, 30))); // s06 e21
ponycountdowndates[21] = new Date((Date.UTC(2016,  9,  8, 15, 30))); // s06 e22
ponycountdowndates[22] = new Date((Date.UTC(2016,  9, 15, 15, 30))); // s06 e23
ponycountdowndates[23] = new Date((Date.UTC(2016,  9, 22, 15, 30))); // s06 e24
ponycountdowndates[24] = new Date((Date.UTC(2016,  9, 29, 15, 30))); // s06 e25
ponycountdowndates[25] = new Date((Date.UTC(2016,  10, 5, 15, 30))); // s06 e26

function updateTimer() {
	var crtime = (new Date()).getTime();
	if(time-crtime<0) {
		//jQuery('#time-header').html('<span>Новая серия:</span> Скоро');
		jQuery('#time-header').html('<span>Новая серия:</span> уже в эфире!');
		clearInterval(intertimer);
		return;
	}
	var ct = new Date(time-crtime);
	if(ct.getDate()>5)
		jQuery('#time-header').html('<span>Новая серия:</span>через '+(ct.getDate()-1)+' дней');
	else if(ct.getDate()>2)
		jQuery('#time-header').html('<span>Новая серия:</span>через '+(ct.getDate()-1)+' дня');
	else if(ct.getDate()>1)
		jQuery('#time-header').html('<span>Новая серия:</span>завтра');
	else
		jQuery('#time-header').html('<span>Новая серия:</span>через<br>'+tform(ct.getUTCHours())+':'+tform(ct.getUTCMinutes())+':'+tform(ct.getUTCSeconds()));
}
function startTimer() {
	for(var i=0;i<ponycountdowndates.length;i++) {
		now=new Date();
		if(ponycountdowndates[i]>(now.getTime()+(now.getTimezoneOffset()*60000))) {
			time = ponycountdowndates[i];
			break;
		}
	}
	intertimer = window.setInterval(updateTimer, 1000);
	updateTimer();
}

function tform(value) {
	if((new String(value)).length<2)
		return '0'+value;
	else
		return value;
}

// scrollup
jQuery( document ).ready(function() {
	jQuery('.scrollup').mouseover( function(){
		jQuery( this ).animate({opacity: 1},10);
	}).mouseout( function(){
		jQuery( this ).animate({opacity: 0.65},10);
	}).click( function(){
		jQuery('body,html').animate({scrollTop: 0}, 600);
		return false;
	});

	jQuery(window).scroll(function(){
		if ( jQuery(document).scrollTop() > 0 ) {
			jQuery('.scrollup').fadeIn('fast');
		} else {
			jQuery('.scrollup').fadeOut('fast');
		}
	});
});

