var sliders = document.querySelectorAll(".book_group")

// slidesWidth - размер всех книг (в процентах) в одном слайде
var slidesWidth = 105

var bookWidhtAndMargin = sliders[0].children[0].parentNode.children[1].children[0].offsetWidth +
											 	 parseInt( getComputedStyle(sliders[0].children[0].parentNode.children[1].children[0]).marginRight )
var booksInSlide = Math.round ( document.querySelector('.slider').offsetWidth / bookWidhtAndMargin )







// Перемещение слайдов пальцем работают так:
// При движении по окну вызывается функция swipeSlider, которой передается перемещаемый слайдер. 
// Перемещаемый слайдер присваивается при mousedown на одном из слайдеров (ниже по коду)

var cursor = {
	is_pressed: false,
	x: 0, y: 0
}
var swipingSlide = null

// В конце файла события для телефонов
window.addEventListener("mousedown", function(e) {
	cursor.is_pressed = true
})
window.addEventListener("mouseup", function() {
	cursor.is_pressed = false

	// Если есть перемещаемый слайдер
	if (swipingSlide) {
		// Вернуть все обратно
		swipingSlide.children[1].children[0].style.transition = '0.5s'
		swipingSlide = null
	}
})
window.addEventListener("mousemove", function(e) {
	if (swipingSlide) {
		swipeSlider(swipingSlide, e)
	}
})





function swipeSlider(slide, e) {
		if (cursor.is_pressed) {
			// Если позиция курсора изменилась более, чем на 5 пикселей
			if (Math.abs(e.clientX - slide.startXPos) > 5) {
				if (e.clientX) {
					var cursorChange = (e.clientX - slide.startXPos)/sliders[0].offsetWidth*100
				}
				if (e.targetTouches) {
					var cursorChange = (e.targetTouches[0].clientX - slide.startXPos)/sliders[0].offsetWidth*100
					alert(cursorChange)
				}

				// Получаем отступ сейчас
				var newMargin = slide.startMargin + cursorChange

				// Запрещает движение за край слайдера
				if (newMargin > 0) {
					newMargin = 0
				}
				if (newMargin < -slidesWidth * slide.slides) {
					newMargin = -slidesWidth * slide.slides
				}

				slide.firstBook_margin = newMargin
				slide.children[1].children[0].style.marginLeft = newMargin + '%'


			}
		}
}





for (var i = 0; i < sliders.length; i++) {
	// Запрещаем перемещение фотографий (это неудобно)
	sliders[i].ondragstart = function(e) {
		e.preventDefault();
	}


	sliders[i].onmousedown = function(e) {
		this.children[1].children[0].style.transition = '0s'
		this.startMargin = this.firstBook_margin

		this.startXPos = e.clientX
		swipingSlide = this
	}

	sliders[i].ontouchstart = function(e) {
		this.children[1].children[0].style.transition = '0s'
		this.startMargin = this.firstBook_margin

		this.startXPos = e.targetTouches[0].clientX
		swipingSlide = this
	}

	sliders[i].slides = Math.ceil(sliders[i].children[1].children.length / booksInSlide) - 1
	sliders[i].firstBook_margin = 0

	// Если больше одного слайда - показать стрелки перемотки
	if (sliders[i].slides > 0) {
		sliders[i].children[2].children[0].classList.add('active')
	}






	sliders[i].children[0].onclick = function () {

		var firstBook = this.parentNode.children[1].children[0]
		var firstBook_margin = this.parentNode.firstBook_margin

			// Если последний слайд - листнуть в конец
			if (this.parentNode.firstBook_margin == 0 ) {
				firstBook.style.marginLeft = -slidesWidth * this.parentNode.slides + '%'
				this.parentNode.firstBook_margin = -slidesWidth * this.parentNode.slides
				return
			}
			// Если до конца прокрутри не хватает совсем чуть-чуть - прокрутить в начало
			if (-this.parentNode.firstBook_margin - slidesWidth <= 0) {
				firstBook.style.marginLeft = 0
				this.parentNode.firstBook_margin = 0
			}
			// Иначе - листнуть вправо. slidesWidth - размер всех книг (в процентах) в одном слайде
			else {
				firstBook.style.marginLeft = firstBook_margin + slidesWidth + "%"
				this.parentNode.firstBook_margin += slidesWidth
			}
		

	}





	sliders[i].children[2].onclick = function () {

		var firstBook = this.parentNode.children[1].children[0]
		var firstBook_margin = this.parentNode.firstBook_margin

			// Если последний слайд - листнуть в начало
			if (this.parentNode.firstBook_margin == -slidesWidth * this.parentNode.slides) {
				firstBook.style.marginLeft = 0
				this.parentNode.firstBook_margin = 0
				return
			}
			// Если до конца прокрутри не хватает совсем чуть-чуть - прокрутить в конец
			if (-this.parentNode.firstBook_margin + slidesWidth > slidesWidth * this.parentNode.slides) {
				firstBook.style.marginLeft = -slidesWidth * this.parentNode.slides + '%'
				this.parentNode.firstBook_margin = -slidesWidth * this.parentNode.slides
			}
			// Иначе - листнуть влево. slidesWidth - размер всех книг (в процентах) в одном слайде
			else {
				firstBook.style.marginLeft = firstBook_margin - slidesWidth + "%"
				this.parentNode.firstBook_margin -= slidesWidth
			}



	}



}






window.onresize = function() {
	// Переопределяет переменные
	bookWidhtAndMargin = sliders[0].children[0].parentNode.children[1].children[0].offsetWidth
											 + parseInt( getComputedStyle(sliders[0].children[0].parentNode.children[1].children[0]).marginRight )
	booksInSlide = Math.round( document.querySelector('.slider').offsetWidth / bookWidhtAndMargin )
}














window.addEventListener("touchstart", function(e) {
	cursor.is_pressed = true
})
window.addEventListener("touchend", function() {
	cursor.is_pressed = false

	// Если есть перемещаемый слайдер
	if (swipingSlide) {
		// Вернуть все обратно
		swipingSlide.children[1].children[0].style.transition = '0.5s'
		swipingSlide = null
	}
})
window.addEventListener("touchmove", function(e) {
	if (swipingSlide) {
		alert(123)
		swipeSlider(swipingSlide, e)
	}
})