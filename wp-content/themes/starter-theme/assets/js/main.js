document.addEventListener('DOMContentLoaded',
    () => {
        const html = document.querySelector('html'),
            isMobile = window.innerWidth < 769
        if (isMobile) {
            mobileMenuHandler()
        }
        authModalHandler()
        searchModalHandler()
        archiveFilterResetFunction()
        archiveOrderingFormHandler()
        plusMinusInputHandler()
        accordionHandler()
        variation_change_handler()
        cartModalInitHandler()
        tabsHandler()
        passwordInputEyeHandler()

        function passwordInputEyeHandler()
        {
            const eyeLinks = document.querySelectorAll('.eye-link')
            if(eyeLinks.length === 0) {
                return
            }
            eyeLinks.forEach(link => {
                link.addEventListener('click',(e) => {
                    e.preventDefault()
                    const input = link.closest('label').querySelector('input'),
                        isActive = link.getAttribute('data-active') === 'true'
                    if(isActive) {
                        input.type = 'password'
                    } else  {
                        input.type = 'text'
                    }
                    link.setAttribute('data-active',!isActive)
                })
            })
        }
        function authModalHandler() {
            const authInitBtns = document.querySelectorAll('.auth-init-button'),
                authModal = document.querySelector('#authModal'),
                closeModalBtn = document.querySelector('#auth-close-btn')
            if (authInitBtns.length === 0 || !authModal) {
                return
            }
            authInitBtns.forEach(btn => {
                btn.addEventListener('click',() => {
                    authModal.classList.remove('hidden')
                })
            })
            authModal.addEventListener('click',(event) => {
                let target = event.target
                if(target.classList.contains('auth-wrapper') || target.closest('.auth-wrapper')) {
                    return
                }
                authModal.classList.add('hidden')
            })
            closeModalBtn.addEventListener('click',() => {
                authModal.classList.add('hidden')
            })
        }

        function tabsHandler() {
            const tabsWrappers = document.querySelectorAll('.tab-wrapper')
            if (tabsWrappers.length === 0) {
                return
            }
            tabsWrappers.forEach(tabWrapper => {
                const buttons = tabWrapper.querySelectorAll('.tabs-btn'),
                    tabItems = tabWrapper.querySelectorAll('.tab-item')
                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        let currentId = btn.getAttribute('data-tab-id'),
                            currentItem = document.querySelector(`#${currentId}`)
                        if (currentItem) {
                            resetAllTabs(buttons, tabItems)
                            open(btn)
                            open(currentItem)
                        }
                    })
                })
            })

            function resetAllTabs(buttons, items) {
                buttons.forEach(btn => close(btn))
                items.forEach(item => close(item))
            }

            function close(item) {
                item.setAttribute('data-active', false)
            }

            function open(item) {
                item.setAttribute('data-active', true)
            }
        }

        function cartModalInitHandler() {
            const cartModal = document.querySelector('#cart-modal'),
                cartInitButton = document.querySelector('#cart-init-btn'),
                cartCloseBtn = document.querySelector('#cart-modal-close-btn')
            if (!cartModal || !cartInitButton) {
                return
            }
            cartInitButton.addEventListener('click', () => openCartModal())
            cartCloseBtn.addEventListener('click', () => closeCartModal())
            cartModal.addEventListener('click', (event) => {
                let target = event.target
                if (target.classList.contains('modal-cart') || target.closest('.modal-cart')) {
                    return
                }
                closeCartModal()
            })

            function openCartModal() {
                cartModal.classList.remove('hidden')
                window.setTimeout(function () {
                    cartModal.setAttribute('data-open', true)
                }, 100)
            }

            function closeCartModal() {
                cartModal.setAttribute('data-open', false)
                window.setTimeout(function () {
                    cartModal.classList.add('hidden')
                }, 300)
            }
        }

        function variation_change_handler() {
            const variationForm = document.querySelector('.variations_form')
            if (!variationForm) {
                return
            }
            const radioInputs = variationForm.querySelectorAll('input[type=radio]')
            if (radioInputs.length === 0) {
                return;
            }
            radioInputs.forEach(input => {
                let currentSelect = input.closest('.attribute-wrapper').querySelector('select'),
                    attributeLabel = document.getElementById(`label_${input.getAttribute('name')}`)
                input.addEventListener('change', (event) => {
                    if (!currentSelect) {
                        return
                    }
                    currentSelect.value = input.value
                    const eventChange = new Event('change', {bubbles: true});
                    currentSelect.dispatchEvent(eventChange);
                    attributeLabel.innerHTML = input.value
                })
            })
        }

        function mobileMenuHandler() {
            const burger = document.getElementById('burger'),
                menu = document.getElementById('menu-wrapper'),
                header = document.getElementById('header')
            if (!burger || !menu) {
                return
            }
            burger.addEventListener("click", () => {
                let isOpen = burger.classList.contains('active')
                if (isOpen) {
                    menu.setAttribute('data-open', false)
                    burger.classList.remove('active')
                    window.setTimeout(() => header.setAttribute('data-menu-open', false), 500)
                } else {
                    header.setAttribute('data-menu-open', true)
                    burger.classList.add('active')
                    menu.setAttribute('data-open', true)
                }
            })
        }

        function searchModalHandler() {
            const searchInitBtns = document.querySelectorAll('.search-button'),
                searchModal = document.querySelector('#search-modal')
            if (searchInitBtns.length === 0 || !searchModal) {
                return
            }
            searchInitBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    searchModal.setAttribute('data-open', true)
                })
            })
            searchModal.addEventListener('click', (event) => {
                let target = event.target
                if (target.classList.contains('search-form') || target.closest('.search-form')) {
                    return
                }
                searchModal.setAttribute('data-open', 'false')
            })
        }

        function archiveFilterResetFunction() {
            const form = document.querySelector('#archive-filter form')
            if (!form) {
                return
            }
            if (window.innerWidth < 1024) {
                const filterToggleButton = document.querySelector('#mobile-filter-button'),
                    formWrapper = document.querySelector('#archive-filter')
                filterToggleButton.addEventListener('click', () => {
                    let isOpen = formWrapper.getAttribute('data-open'),
                        attrValue = isOpen === 'false' ? 'true' : 'false'
                    filterToggleButton.setAttribute('data-open', attrValue)
                    formWrapper.setAttribute('data-open', attrValue)
                })
            }
            const resetFilterBtn = form.querySelector('#reset-filter-btn')
            resetFilterBtn.addEventListener('click', (event) => {
                event.preventDefault()
                let inputs = form.querySelectorAll('input[type=checkbox]')
                if (inputs.length > 0) {
                    inputs.forEach(input => {
                        input.checked = false
                    })
                }
                form.submit()
            })
        }

        function archiveOrderingFormHandler() {
            const formWrapper = document.querySelector('#archive-ordering-widget'),
                formToggleButton = document.querySelector('#archive-ordering-button')
            if (!formWrapper || !formToggleButton) {
                return
            }
            const inputs = formWrapper.querySelectorAll('input[type=radio]'),
                form = formWrapper.querySelector('form')
            formToggleButton.addEventListener('click', () => formWrapper.classList.toggle('active'))
            inputs.forEach(input => {
                input.addEventListener('change', () => {
                    form.submit()
                })
            })
        }

        function plusMinusInputHandler() {
            const qtyInputs = document.querySelectorAll('input.qty')
            if (qtyInputs.length === 0) {
                return
            }
            qtyInputs.forEach(input => {
                const wrapper = input.closest('.qty-wrapper'),
                    minusBtn = wrapper.querySelector('.minus-btn'),
                    plusBtn = wrapper.querySelector('.plus-btn'),
                    step = parseInt(input.getAttribute('step')),
                    minValue = input.getAttribute('min') ? parseInt(input.getAttribute('min')) : 1,
                    maxValue = input.getAttribute('max') ? parseInt(input.getAttribute('max')) : 100
                plusBtn.addEventListener('click', (event) => {
                    event.preventDefault()
                    plusHandler(input, maxValue, minValue, step, plusBtn, minusBtn)
                })
                minusBtn.addEventListener('click', (event) => {
                    event.preventDefault()
                    minusHandler(input, maxValue, minValue, step, plusBtn, minusBtn)
                })
                if (parseInt(input.value) === minValue) {
                    disableButtonHandler(minusBtn)
                }
            })

            function plusHandler(input, maxValue, minValue, step, plusButton, minusButton) {
                const value = parseInt(input.value),
                    nextValue = value + step
                if (nextValue > maxValue) {
                    return
                }
                checkButtonsAvailability(nextValue, plusButton, minusButton, minValue, maxValue)
                input.value = nextValue
            }

            function minusHandler(input, maxValue, minValue, step, plusButton, minusButton) {
                const value = parseInt(input.value),
                    nextValue = value - step
                if (nextValue < minValue) {
                    return
                }
                checkButtonsAvailability(nextValue, plusButton, minusButton, minValue, maxValue)
                input.value = nextValue
            }

            function checkButtonsAvailability(value, plusBtn, minusBtn, minValue, maxValue) {
                let isMinusDisabled = value === minValue,
                    isPlusDisabled = value === maxValue
                if (isMinusDisabled) {
                    disableButtonHandler(minusBtn)
                } else {
                    enableButtonHandler(minusBtn)
                }
                if (isPlusDisabled) {
                    disableButtonHandler(plusBtn)
                } else {
                    enableButtonHandler(plusBtn)
                }
            }

            function disableButtonHandler(button) {
                button.classList.add('disabled')
            }

            function enableButtonHandler(button) {
                if (button.classList.contains('disabled')) {
                    button.classList.remove('disabled')
                }
            }
        }

        function accordionHandler() {
            const accordions = document.querySelectorAll('.accordion')
            if (accordions.length === 0) {
                return
            }
            accordions.forEach(accordion => {
                const toggleButtons = accordion.querySelectorAll('.accordion-button')
                toggleButtons.forEach(btn => {
                    btn.addEventListener('click', (event) => {
                        event.preventDefault()
                        const item = btn.closest('.accordion-item'),
                            dropDown = item.querySelector('.accordion-dropdown'),
                            isOpen = item.getAttribute('data-open') === 'true'
                        if (isOpen) {
                            item.setAttribute('data-open', false)
                            dropDown.style.maxHeight = 0
                            window.setTimeout(function () {
                                dropDown.classList.add('hidden')
                            }, 150)
                        } else {
                            dropDown.classList.remove('hidden')
                            item.setAttribute('data-open', true)
                            dropDown.style.maxHeight = dropDown.scrollHeight + 'px'
                        }
                    })
                })
            })
        }
    })
