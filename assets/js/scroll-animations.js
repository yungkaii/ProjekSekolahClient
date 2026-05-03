/**
 * Enhanced Scroll Animation Script
 * Provides additional animation effects and improvements
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ========================
    // SCROLL PROGRESS BAR
    // ========================
    const createProgressBar = () => {
        if (!document.querySelector('.scroll-progress-bar')) {
            const progressBar = document.createElement('div');
            progressBar.className = 'scroll-progress-bar';
            document.body.insertBefore(progressBar, document.body.firstChild);
            
            window.addEventListener('scroll', () => {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollPercent = (scrollTop / docHeight) * 100;
                progressBar.style.width = scrollPercent + '%';
            });
        }
    };
    createProgressBar();

    // ========================
    // STAGGER ANIMATION FOR LISTS
    // ========================
    const staggerElements = (container, itemSelector = '.scroll-animate', staggerDelay = 100) => {
        const items = container.querySelectorAll(itemSelector);
        items.forEach((item, index) => {
            const delay = (index * staggerDelay) / 1000;
            item.style.animationDelay = delay + 's';
        });
    };

    // Apply stagger to common containers
    document.querySelectorAll('.berita-side, .galeri-grid, .ekskul-grid').forEach(container => {
        staggerElements(container);
    });

    // ========================
    // TEXT ANIMATION - Character reveal
    // ========================
    const animateTextReveal = (element) => {
        if (element.dataset.animated) return;
        
        const text = element.textContent;
        element.innerHTML = text
            .split('')
            .map((char, index) => {
                const delay = (index * 20) / 1000;
                return `<span style="animation: charReveal 0.6s ease-out ${delay}s forwards; opacity: 0;">${char}</span>`;
            })
            .join('');
        
        element.dataset.animated = 'true';
    };

    // Optional: Apply to headings
    // document.querySelectorAll('h1, h2, h3').forEach(h => animateTextReveal(h));

    // ========================
    // COUNTER ANIMATION
    // ========================
    const initCounters = () => {
        const counters = document.querySelectorAll('[data-counter-target]');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-counter-target')) || 0;
            const duration = parseInt(counter.getAttribute('data-counter-duration')) || 1500;
            const separator = counter.getAttribute('data-counter-separator') || '';
            
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    let current = 0;
                    const step = target / (duration / 16);
                    
                    const updateCounter = () => {
                        current += step;
                        if (current < target) {
                            counter.textContent = Math.floor(current).toLocaleString('id-ID');
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target.toLocaleString('id-ID');
                        }
                        if (separator) counter.textContent += separator;
                    };
                    
                    updateCounter();
                    observer.unobserve(counter);
                }
            }, { threshold: 0.5 });
            
            observer.observe(counter);
        });
    };
    initCounters();

    // ========================
    // PARALLAX SCROLL EFFECT
    // ========================
    const initParallax = () => {
        const parallaxElements = document.querySelectorAll('[data-parallax-speed]');
        if (parallaxElements.length === 0) return;
        
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrollY = window.scrollY;
                    parallaxElements.forEach(el => {
                        const speed = parseFloat(el.getAttribute('data-parallax-speed')) || 0.5;
                        el.style.transform = `translateY(${scrollY * speed}px)`;
                    });
                    ticking = false;
                });
                ticking = true;
            }
        });
    };
    initParallax();

    // ========================
    // SCROLL TRIGGERED CLASS
    // ========================
    const scrollTrigger = (selector, className = 'in-view', threshold = 0.5) => {
        const elements = document.querySelectorAll(selector);
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add(className);
                }
            });
        }, { threshold });
        
        elements.forEach(el => observer.observe(el));
    };

    // Apply scroll trigger to cards
    scrollTrigger('.card');
    scrollTrigger('.berita-side-card');
    scrollTrigger('.galeri-card');
    scrollTrigger('.ekskul-card');

    // ========================
    // SMOOTH REVEAL FOR IMAGES
    // ========================
    const imageReveal = () => {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('image-loaded');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    };
    imageReveal();

    // ========================
    // ADD ANIMATION STYLES TO HEAD
    // ========================
    const addAnimationStyles = () => {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes charReveal {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }

            img.image-loaded {
                animation: fadeIn 0.6s ease-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .scroll-progress-bar {
                position: fixed;
                top: 0;
                left: 0;
                height: 4px;
                background: linear-gradient(90deg, #198754, #20c997);
                width: 0%;
                z-index: 9999;
                transition: width 0.1s ease;
            }

            .in-view {
                animation: slideUp 0.8s ease forwards;
            }
        `;
        document.head.appendChild(style);
    };
    addAnimationStyles();

    // ========================
    // ELEMENT VISIBILITY LOGGER (Optional - for debugging)
    // ========================
    const debugScrollAnimations = false; // Set to true for debugging
    if (debugScrollAnimations) {
        const debugElements = document.querySelectorAll('.scroll-animate');
        console.log(`Found ${debugElements.length} scroll-animate elements`);
        debugElements.forEach((el, i) => {
            console.log(`Element ${i}:`, el.className, el.tagName);
        });
    }
});
