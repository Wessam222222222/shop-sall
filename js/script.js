// وظائف JavaScript لموقع شركة الوسام للتكنولوجيا والبرمجة

// انتظار تحميل المستند بالكامل
document.addEventListener('DOMContentLoaded', function() {
    // تفعيل التمرير السلس للروابط
    smoothScroll();
    
    // تفعيل التحقق من صحة نموذج الاتصال
    validateContactForm();
    
    // تفعيل تأثيرات التمرير
    scrollEffects();
    
    // تفعيل القائمة المتجاوبة للهواتف المحمولة
    mobileMenu();
    
    // إضافة تاريخ السنة الحالية في الفوتر
    updateYear();
});

// وظيفة التمرير السلس للروابط
function smoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    for (const link of links) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    }
}

// وظيفة التحقق من صحة نموذج الاتصال
function validateContactForm() {
    const contactForm = document.querySelector('.contact-form form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // الحصول على قيم الحقول
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const messageInput = document.getElementById('message');
            
            // التحقق من الاسم
            if (nameInput.value.trim() === '') {
                showError(nameInput, 'يرجى إدخال الاسم');
                return;
            } else {
                removeError(nameInput);
            }
            
            // التحقق من البريد الإلكتروني
            if (emailInput.value.trim() === '') {
                showError(emailInput, 'يرجى إدخال البريد الإلكتروني');
                return;
            } else if (!isValidEmail(emailInput.value)) {
                showError(emailInput, 'يرجى إدخال بريد إلكتروني صحيح');
                return;
            } else {
                removeError(emailInput);
            }
            
            // التحقق من الرسالة
            if (messageInput.value.trim() === '') {
                showError(messageInput, 'يرجى إدخال رسالتك');
                return;
            } else {
                removeError(messageInput);
            }
            
            // إظهار رسالة نجاح إرسال النموذج
            showSuccessMessage(contactForm);
            
            // إعادة تعيين النموذج
            contactForm.reset();
        });
    }
}

// وظيفة إظهار رسالة خطأ
function showError(input, message) {
    // إزالة أي رسالة خطأ سابقة
    removeError(input);
    
    // إنشاء عنصر رسالة الخطأ
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    errorMessage.textContent = message;
    errorMessage.style.color = 'var(--error-color)';
    errorMessage.style.fontSize = '0.8rem';
    errorMessage.style.marginTop = '5px';
    
    // إضافة حدود حمراء للحقل
    input.style.borderColor = 'var(--error-color)';
    
    // إضافة رسالة الخطأ بعد الحقل
    input.parentNode.appendChild(errorMessage);
}

// وظيفة إزالة رسالة الخطأ
function removeError(input) {
    // إعادة لون الحدود إلى الافتراضي
    input.style.borderColor = '';
    
    // البحث عن رسالة الخطأ وإزالتها إذا وجدت
    const errorMessage = input.parentNode.querySelector('.error-message');
    if (errorMessage) {
        errorMessage.remove();
    }
}

// وظيفة التحقق من صحة البريد الإلكتروني
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// وظيفة إظهار رسالة نجاح إرسال النموذج
function showSuccessMessage(form) {
    // إنشاء عنصر رسالة النجاح
    const successMessage = document.createElement('div');
    successMessage.className = 'success-message';
    successMessage.textContent = 'تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.';
    successMessage.style.backgroundColor = 'var(--success-color)';
    successMessage.style.color = 'white';
    successMessage.style.padding = '10px';
    successMessage.style.borderRadius = '4px';
    successMessage.style.marginTop = '20px';
    successMessage.style.textAlign = 'center';
    
    // إضافة رسالة النجاح إلى النموذج
    form.appendChild(successMessage);
    
    // إزالة رسالة النجاح بعد 5 ثوانٍ
    setTimeout(() => {
        successMessage.remove();
    }, 5000);
}

// وظيفة تأثيرات التمرير
function scrollEffects() {
    // تحديد العناصر التي ستظهر عند التمرير
    const elementsToAnimate = document.querySelectorAll('.service-card, .project-card, .about-content, .contact-content');
    
    // وظيفة التحقق من ظهور العنصر في نطاق الرؤية
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8
        );
    }
    
    // وظيفة تحديث حالة العناصر
    function updateElementsVisibility() {
        elementsToAnimate.forEach(element => {
            if (isElementInViewport(element)) {
                element.classList.add('visible');
            }
        });
    }
    
    // إضافة فئة CSS للعناصر المرئية عند التمرير
    window.addEventListener('scroll', updateElementsVisibility);
    window.addEventListener('resize', updateElementsVisibility);
    
    // تحديث حالة العناصر عند تحميل الصفحة
    updateElementsVisibility();
    
    // إضافة أنماط CSS للتأثيرات
    const style = document.createElement('style');
    style.textContent = `
        .service-card, .project-card, .about-content, .contact-content {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .service-card.visible, .project-card.visible, .about-content.visible, .contact-content.visible {
            opacity: 1;
            transform: translateY(0);
        }
    `;
    document.head.appendChild(style);
}

// وظيفة القائمة المتجاوبة للهواتف المحمولة
function mobileMenu() {
    // إنشاء زر القائمة للهواتف المحمولة
    const header = document.querySelector('header .container');
    const nav = document.querySelector('header nav');
    
    if (header && nav) {
        const menuButton = document.createElement('div');
        menuButton.className = 'menu-button';
        menuButton.innerHTML = '<i class="fas fa-bars"></i>';
        menuButton.style.display = 'none';
        
        // إضافة زر القائمة قبل عنصر التنقل
        header.insertBefore(menuButton, nav);
        
        // إضافة أنماط CSS للقائمة المتجاوبة
        const style = document.createElement('style');
        style.textContent = `
            @media (max-width: 768px) {
                .menu-button {
                    display: block !important;
                    cursor: pointer;
                    font-size: 1.5rem;
                    color: var(--primary-color);
                }
                
                header .container {
                    flex-direction: row !important;
                    justify-content: space-between !important;
                    align-items: center !important;
                }
                
                header nav {
                    position: absolute;
                    top: 100%;
                    right: 0;
                    left: 0;
                    background-color: var(--white-color);
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                    padding: 1rem;
                    display: none;
                }
                
                header nav.active {
                    display: block;
                }
                
                header nav ul {
                    flex-direction: column;
                    align-items: center;
                }
                
                header nav ul li {
                    margin: 0.5rem 0;
                    width: 100%;
                    text-align: center;
                }
            }
        `;
        document.head.appendChild(style);
        
        // تبديل حالة القائمة عند النقر على الزر
        menuButton.addEventListener('click', function() {
            nav.classList.toggle('active');
            
            // تغيير أيقونة الزر
            const icon = menuButton.querySelector('i');
            if (nav.classList.contains('active')) {
                icon.className = 'fas fa-times';
            } else {
                icon.className = 'fas fa-bars';
            }
        });
        
        // إغلاق القائمة عند النقر على أي رابط
        const navLinks = nav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    nav.classList.remove('active');
                    menuButton.querySelector('i').className = 'fas fa-bars';
                }
            });
        });
    }
}

// وظيفة تحديث السنة في الفوتر
function updateYear() {
    const yearElements = document.querySelectorAll('.footer-bottom');
    const currentYear = new Date().getFullYear();
    
    yearElements.forEach(element => {
        const content = element.innerHTML;
        const updatedContent = content.replace(/\d{4}/, currentYear);
        element.innerHTML = updatedContent;
    });
}

// وظيفة إنشاء صور بديلة في حالة عدم توفر الصور الأصلية
function createPlaceholderImage() {
    // التحقق من وجود ملف الصورة البديلة
    const placeholderImg = new Image();
    placeholderImg.src = '../images/placeholder.jpg';
    
    placeholderImg.onerror = function() {
        // إنشاء عنصر canvas لإنشاء صورة بديلة
        const canvas = document.createElement('canvas');
        canvas.width = 300;
        canvas.height = 200;
        
        const ctx = canvas.getContext('2d');
        
        // تعيين لون الخلفية
        ctx.fillStyle = '#f0f0f0';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // إضافة نص
        ctx.fillStyle = '#999999';
        ctx.font = '20px Tajawal, sans-serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('صورة غير متوفرة', canvas.width / 2, canvas.height / 2);
        
        // تحويل canvas إلى صورة
        const dataUrl = canvas.toDataURL('image/jpeg');
        
        // استبدال جميع الصور التي فشل تحميلها
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.onerror = function() {
                this.src = dataUrl;
                this.onerror = null; // منع التكرار
            };
        });
    };
}
