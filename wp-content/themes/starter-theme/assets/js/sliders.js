document.addEventListener('DOMContentLoaded',() => {
    if(document.querySelector('#category-slider')) {
        new Swiper(document.querySelector('#category-slider'),{
            slidesPerView: 1.5,
            spaceBetween : 22,
            loop : false,
            breakpoints: {
                575 : {
                    slidesPerView: 2.2,
                },
                768 : {
                    slidesPerView: 3,
                },
                1040 : {
                    slidesPerView: 4
                }
            }
        })
    }
    if(document.querySelector('#recent-viewed-slider')) {
        let slidesCount = document.querySelectorAll('#recent-viewed-slider .swiper-slide').length
        new Swiper(document.querySelector('#recent-viewed-slider'),{
            slidesPerView: slidesCount > 1 ? 1.5 : 1,
            spaceBetween : 22,
            loop : false,
            navigation: {
                nextEl: "#recent-viewed-slider .button-next",
                prevEl: "#recent-viewed-slider .button-prev",
            },
            breakpoints: {
                575 : {
                    slidesPerView: 2.2,
                },
                768 : {
                    slidesPerView: 3,
                },
                1040 : {
                    slidesPerView: 4
                }
            }
        })
    }
    if(document.querySelector('#workers-slider')) {
        new Swiper(document.querySelector('#workers-slider'),{
            slidesPerView: 1.5,
            spaceBetween : 22,
            loop : false,
            breakpoints: {
                575 : {
                    slidesPerView: 2.2,
                },
                768 : {
                    slidesPerView: 3,
                },
                1040 : {
                    slidesPerView: 4
                }
            }
        })
    }
    if(document.querySelector('#single-product-slider')) {
        const thumbnailSlider = new Swiper(document.querySelector('#single-thumbnails-slider'),
            {
                slidesPerView: 5,
                spaceBetween : 10,
                loop : false,
                watchSlidesProgress: true,
            })
        const mainSingleSlider = new Swiper(document.querySelector('#single-product-slider'), {
            slidesPerView: 1,
            loop : false,
            thumbs: {
                swiper: thumbnailSlider,
            },
        })

    }
})