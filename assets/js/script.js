setInterval(updateArea, 1000)

function updateArea() {
	const windowHeight = $(document.body).height()
	const posY = $('.course_left').offset().top
	const height = windowHeight - posY
	$('.course_left, .course_right').css('height', `${height}px`)
}