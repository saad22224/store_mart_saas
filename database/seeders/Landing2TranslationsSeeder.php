<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Landing2Translation;

class Landing2TranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Landing2Translation::truncate();

        $translations = [
            // ===== HERO SECTION =====
            ['section' => 'hero', 'field' => 'badge', 'lang' => 'ar', 'value' => 'أكثر من 50,000 تاجر يثقون بنا'],
            ['section' => 'hero', 'field' => 'badge', 'lang' => 'en', 'value' => 'More than 50,000 merchants trust us'],
            
            ['section' => 'hero', 'field' => 'title_line1', 'lang' => 'ar', 'value' => 'أنشئ متجر أحلامك'],
            ['section' => 'hero', 'field' => 'title_line1', 'lang' => 'en', 'value' => 'Create your dream store'],
            ['section' => 'hero', 'field' => 'title_highlight', 'lang' => 'ar', 'value' => 'في ثوانٍ معدودة'],
            ['section' => 'hero', 'field' => 'title_highlight', 'lang' => 'en', 'value' => 'in seconds'],
            
            ['section' => 'hero', 'field' => 'description', 'lang' => 'ar', 'value' => 'منصة متكاملة تمنحك كل ما تحتاجه لإطلاق تجارتك الإلكترونية، من التصميم الاحترافي إلى إدارة المدفوعات والشحن، دون الحاجة لخبرة برمجية.'],
            ['section' => 'hero', 'field' => 'description', 'lang' => 'en', 'value' => 'An integrated platform that gives you everything you need to launch your e-commerce, from professional design to payment and shipping management, without the need for programming experience.'],
            
            ['section' => 'hero', 'field' => 'btn_primary', 'lang' => 'ar', 'value' => 'ابدأ مجاناً الآن'],
            ['section' => 'hero', 'field' => 'btn_primary', 'lang' => 'en', 'value' => 'Start Free Now'],
            ['section' => 'hero', 'field' => 'btn_secondary', 'lang' => 'ar', 'value' => 'شاهد العرض التجريبي'],
            ['section' => 'hero', 'field' => 'btn_secondary', 'lang' => 'en', 'value' => 'Watch Demo'],

            // ===== NAVIGATION =====
            ['section' => 'nav', 'field' => 'home', 'lang' => 'ar', 'value' => 'الرئيسية'],
            ['section' => 'nav', 'field' => 'home', 'lang' => 'en', 'value' => 'Home'],
            ['section' => 'nav', 'field' => 'who_we_are', 'lang' => 'ar', 'value' => 'من نحن'],
            ['section' => 'nav', 'field' => 'who_we_are', 'lang' => 'en', 'value' => 'About Us'],
            ['section' => 'nav', 'field' => 'why_us', 'lang' => 'ar', 'value' => 'لماذا نحن'],
            ['section' => 'nav', 'field' => 'why_us', 'lang' => 'en', 'value' => 'Why Us'],
            ['section' => 'nav', 'field' => 'faq', 'lang' => 'ar', 'value' => 'الأسئلة'],
            ['section' => 'nav', 'field' => 'faq', 'lang' => 'en', 'value' => 'FAQ'],
            ['section' => 'nav', 'field' => 'contact', 'lang' => 'ar', 'value' => 'اتصل بنا'],
            ['section' => 'nav', 'field' => 'contact', 'lang' => 'en', 'value' => 'Contact'],
            ['section' => 'nav', 'field' => 'start_now', 'lang' => 'ar', 'value' => 'ابدأ الآن'],
            ['section' => 'nav', 'field' => 'start_now', 'lang' => 'en', 'value' => 'Start Now'],

            // ===== STATS SECTION =====
            ['section' => 'stats', 'field' => 'stat1_number', 'lang' => 'ar', 'value' => '99.9%'],
            ['section' => 'stats', 'field' => 'stat1_number', 'lang' => 'en', 'value' => '99.9%'],
            ['section' => 'stats', 'field' => 'stat1_label', 'lang' => 'ar', 'value' => 'استمرارية الخدمة'],
            ['section' => 'stats', 'field' => 'stat1_label', 'lang' => 'en', 'value' => 'Uptime'],
            
            ['section' => 'stats', 'field' => 'stat2_number', 'lang' => 'ar', 'value' => '50k+'],
            ['section' => 'stats', 'field' => 'stat2_number', 'lang' => 'en', 'value' => '50k+'],
            ['section' => 'stats', 'field' => 'stat2_label', 'lang' => 'ar', 'value' => 'متجر نشط'],
            ['section' => 'stats', 'field' => 'stat2_label', 'lang' => 'en', 'value' => 'Active Stores'],
            
            ['section' => 'stats', 'field' => 'stat3_number', 'lang' => 'ar', 'value' => '120M+'],
            ['section' => 'stats', 'field' => 'stat3_number', 'lang' => 'en', 'value' => '120M+'],
            ['section' => 'stats', 'field' => 'stat3_label', 'lang' => 'ar', 'value' => 'مبيعات سنوية'],
            ['section' => 'stats', 'field' => 'stat3_label', 'lang' => 'en', 'value' => 'Annual Sales'],
            
            ['section' => 'stats', 'field' => 'stat4_number', 'lang' => 'ar', 'value' => '24/7'],
            ['section' => 'stats', 'field' => 'stat4_number', 'lang' => 'en', 'value' => '24/7'],
            ['section' => 'stats', 'field' => 'stat4_label', 'lang' => 'ar', 'value' => 'دعم فني مباشر'],
            ['section' => 'stats', 'field' => 'stat4_label', 'lang' => 'en', 'value' => '24/7 Support'],

            // ===== WHO WE ARE SECTION =====
            ['section' => 'who_we_are', 'field' => 'tag', 'lang' => 'ar', 'value' => 'تعرّف علينا'],
            ['section' => 'who_we_are', 'field' => 'tag', 'lang' => 'en', 'value' => 'Get to know us'],
            ['section' => 'who_we_are', 'field' => 'title_line1', 'lang' => 'ar', 'value' => 'نحن فريق شغوف بـ'],
            ['section' => 'who_we_are', 'field' => 'title_line1', 'lang' => 'en', 'value' => 'We are a team passionate'],
            ['section' => 'who_we_are', 'field' => 'title_highlight', 'lang' => 'ar', 'value' => 'تمكين التجارة الرقمية'],
            ['section' => 'who_we_are', 'field' => 'title_highlight', 'lang' => 'en', 'value' => 'about enabling digital commerce'],
            
            ['section' => 'who_we_are', 'field' => 'description1', 'lang' => 'ar', 'value' => 'Matjar Hub منصة سعودية نشأت من رحم التحديات التي يواجهها التجار العرب يومياً. هدفنا الأول هو إزالة العقبات التقنية وتسليم التاجر مفاتيح متجره الاحترافي في أقل من دقيقة.'],
            ['section' => 'who_we_are', 'field' => 'description1', 'lang' => 'en', 'value' => 'Matjar Hub is a Saudi platform that was born out of the challenges faced by Arab merchants daily. Our first goal is to remove technical obstacles and deliver the keys to a professional store in less than a minute.'],
            
            ['section' => 'who_we_are', 'field' => 'description2', 'lang' => 'ar', 'value' => 'نُؤمن بأن كل فكرة تستحق أن تُبنى، وكل تاجر يستحق أدوات عالمية المستوى بسعر في متناول الجميع. لذلك بنينا Matjar Hub على ثلاثة مبادئ: السرعة، البساطة، والموثوقية.'],
            ['section' => 'who_we_are', 'field' => 'description2', 'lang' => 'en', 'value' => 'We believe that every idea deserves to be built, and every merchant deserves world-class tools at an affordable price. That is why we built Matjar Hub on three principles: Speed, Simplicity, and Reliability.'],
            
            ['section' => 'who_we_are', 'field' => 'stat1_number', 'lang' => 'ar', 'value' => '2019'],
            ['section' => 'who_we_are', 'field' => 'stat1_number', 'lang' => 'en', 'value' => '2019'],
            ['section' => 'who_we_are', 'field' => 'stat1_label', 'lang' => 'ar', 'value' => 'سنة التأسيس'],
            ['section' => 'who_we_are', 'field' => 'stat1_label', 'lang' => 'en', 'value' => 'Founded Year'],
            
            ['section' => 'who_we_are', 'field' => 'stat2_number', 'lang' => 'ar', 'value' => '+50'],
            ['section' => 'who_we_are', 'field' => 'stat2_number', 'lang' => 'en', 'value' => '+50'],
            ['section' => 'who_we_are', 'field' => 'stat2_label', 'lang' => 'ar', 'value' => 'موظف متخصص'],
            ['section' => 'who_we_are', 'field' => 'stat2_label', 'lang' => 'en', 'value' => 'Specialized Employees'],
            
            ['section' => 'who_we_are', 'field' => 'stat3_number', 'lang' => 'ar', 'value' => '15+'],
            ['section' => 'who_we_are', 'field' => 'stat3_number', 'lang' => 'en', 'value' => '15+'],
            ['section' => 'who_we_are', 'field' => 'stat3_label', 'lang' => 'ar', 'value' => 'دولة عربية'],
            ['section' => 'who_we_are', 'field' => 'stat3_label', 'lang' => 'en', 'value' => 'Arab Countries'],
            
            ['section' => 'who_we_are', 'field' => 'float_badge_title', 'lang' => 'ar', 'value' => 'موثّق ومعتمد'],
            ['section' => 'who_we_are', 'field' => 'float_badge_title', 'lang' => 'en', 'value' => 'Verified & Certified'],
            ['section' => 'who_we_are', 'field' => 'float_badge_subtitle', 'lang' => 'ar', 'value' => 'شريك تقني معتمد في المنطقة'],
            ['section' => 'who_we_are', 'field' => 'float_badge_subtitle', 'lang' => 'en', 'value' => 'Certified Tech Partner'],

            // ===== WHY US SECTION =====
            ['section' => 'why_us', 'field' => 'title', 'lang' => 'ar', 'value' => 'لماذا تختار'],
            ['section' => 'why_us', 'field' => 'title', 'lang' => 'en', 'value' => 'Why choose'],
            ['section' => 'why_us', 'field' => 'title_highlight', 'lang' => 'ar', 'value' => 'Matjar Hub؟'],
            ['section' => 'why_us', 'field' => 'title_highlight', 'lang' => 'en', 'value' => 'Matjar Hub?'],
            ['section' => 'why_us', 'field' => 'subtitle', 'lang' => 'ar', 'value' => 'نحن نوفر لك كل الأدوات التي تحتاجها للنجاح في عالم التجارة الإلكترونية، مع التركيز على البساطة والقوة في وقت واحد.'],
            ['section' => 'why_us', 'field' => 'subtitle', 'lang' => 'en', 'value' => 'We provide you with all the tools you need to succeed in the world of e-commerce, focusing on simplicity and power at the same time.'],
            
            // Card 1
            ['section' => 'why_us', 'field' => 'card1_title', 'lang' => 'ar', 'value' => 'سرعة خارقة'],
            ['section' => 'why_us', 'field' => 'card1_title', 'lang' => 'en', 'value' => 'Super Speed'],
            ['section' => 'why_us', 'field' => 'card1_desc', 'lang' => 'ar', 'value' => 'متاجرك تعمل على أحدث التقنيات السحابية لضمان سرعة تحميل لا تضاهى عالمياً.'],
            ['section' => 'why_us', 'field' => 'card1_desc', 'lang' => 'en', 'value' => 'Your stores run on the latest cloud technologies to ensure unbeatable loading speeds worldwide.'],
            
            // Card 2
            ['section' => 'why_us', 'field' => 'card2_title', 'lang' => 'ar', 'value' => 'دعم فني 24/7'],
            ['section' => 'why_us', 'field' => 'card2_title', 'lang' => 'en', 'value' => '24/7 Support'],
            ['section' => 'why_us', 'field' => 'card2_desc', 'lang' => 'ar', 'value' => 'فريقنا متواجد دائماً لمساعدتك في كل خطوة، عبر الواتساب، الهاتف، أو البريد.'],
            ['section' => 'why_us', 'field' => 'card2_desc', 'lang' => 'en', 'value' => 'Our team is always available to help you at every step, via WhatsApp, phone, or email.'],
            
            // Card 3
            ['section' => 'why_us', 'field' => 'card3_title', 'lang' => 'ar', 'value' => 'تكامل شامل'],
            ['section' => 'why_us', 'field' => 'card3_title', 'lang' => 'en', 'value' => 'Comprehensive Integration'],
            ['section' => 'why_us', 'field' => 'card3_desc', 'lang' => 'ar', 'value' => 'اربط متجرك مع كافة خدمات الشحن والدفع والتسويق بضغطة زر واحدة.'],
            ['section' => 'why_us', 'field' => 'card3_desc', 'lang' => 'en', 'value' => 'Connect your store with all shipping, payment, and marketing services with one click.'],

            // ===== VALUE SECTION =====
            ['section' => 'value', 'field' => 'badge', 'lang' => 'ar', 'value' => 'رسالتنا وقيمنا'],
            ['section' => 'value', 'field' => 'badge', 'lang' => 'en', 'value' => 'Our Mission & Values'],
            ['section' => 'value', 'field' => 'title_line1', 'lang' => 'ar', 'value' => 'نمكّن التجار في'],
            ['section' => 'value', 'field' => 'title_line1', 'lang' => 'en', 'value' => 'Empowering merchants in'],
            ['section' => 'value', 'field' => 'title_highlight', 'lang' => 'ar', 'value' => 'العالم العربي'],
            ['section' => 'value', 'field' => 'title_highlight', 'lang' => 'en', 'value' => 'the Arab World'],
            ['section' => 'value', 'field' => 'title_line2', 'lang' => 'ar', 'value' => 'للوصول للعالمية'],
            ['section' => 'value', 'field' => 'title_line2', 'lang' => 'en', 'value' => 'to go global'],
            
            ['section' => 'value', 'field' => 'description', 'lang' => 'ar', 'value' => 'انطلقت منصة Matjar Hub لتكون الشريك الأول لكل طموح يريد البدء في تجارته الخاصة. نحن نؤمن أن التكنولوجيا لا يجب أن تكون عائقاً أمام الإبداع، لذلك عملنا على تبسيط كل العمليات المعقدة.'],
            ['section' => 'value', 'field' => 'description', 'lang' => 'en', 'value' => 'Matjar Hub was launched to be the first partner for every ambitious person who wants to start their own business. We believe that technology should not be an obstacle to creativity, so we worked on simplifying all complex processes.'],
            
            ['section' => 'value', 'field' => 'check1', 'lang' => 'ar', 'value' => 'سهولة الاستخدام'],
            ['section' => 'value', 'field' => 'check1', 'lang' => 'en', 'value' => 'Ease of Use'],
            ['section' => 'value', 'field' => 'check2', 'lang' => 'ar', 'value' => 'أمان عالي'],
            ['section' => 'value', 'field' => 'check2', 'lang' => 'en', 'value' => 'High Security'],
            ['section' => 'value', 'field' => 'check3', 'lang' => 'ar', 'value' => 'تطوير مستمر'],
            ['section' => 'value', 'field' => 'check3', 'lang' => 'en', 'value' => 'Continuous Development'],
            ['section' => 'value', 'field' => 'check4', 'lang' => 'ar', 'value' => 'شفافية تامة'],
            ['section' => 'value', 'field' => 'check4', 'lang' => 'en', 'value' => 'Total Transparency'],

            // ===== FAQ SECTION =====
            ['section' => 'faq', 'field' => 'title', 'lang' => 'ar', 'value' => 'الأسئلة الشائعة'],
            ['section' => 'faq', 'field' => 'title', 'lang' => 'en', 'value' => 'Frequently Asked Questions'],
            ['section' => 'faq', 'field' => 'subtitle', 'lang' => 'ar', 'value' => 'كل ما تود معرفته عن المنصة وكيفية البدء'],
            ['section' => 'faq', 'field' => 'subtitle', 'lang' => 'en', 'value' => 'Everything you want to know about the platform and how to start'],
            
            // FAQ 1
            ['section' => 'faq', 'field' => 'q1', 'lang' => 'ar', 'value' => 'هل أحتاج لخبرة في البرمجة لإنشاء متجري على Matjar Hub؟'],
            ['section' => 'faq', 'field' => 'q1', 'lang' => 'en', 'value' => 'Do I need programming experience to create my store on Matjar Hub?'],
            ['section' => 'faq', 'field' => 'a1', 'lang' => 'ar', 'value' => 'بالتأكيد لا! لقد صممنا المنصة لتكون سهلة الاستخدام للجميع. يمكنك اختيار قالب جاهز وتخصيصه بسهولة باستخدام واجهة السحب والإفلات البسيطة.'],
            ['section' => 'faq', 'field' => 'a1', 'lang' => 'en', 'value' => 'Absolutely not! We designed the platform to be easy for everyone to use. You can choose a ready-made template and easily customize it using a simple drag-and-drop interface.'],
            
            // FAQ 2
            ['section' => 'faq', 'field' => 'q2', 'lang' => 'ar', 'value' => 'ما هي تكلفة البدء مع Matjar Hub؟'],
            ['section' => 'faq', 'field' => 'q2', 'lang' => 'en', 'value' => 'What is the cost of starting with Matjar Hub?'],
            ['section' => 'faq', 'field' => 'a2', 'lang' => 'ar', 'value' => 'نوفر خطة مجانية للبدء، مع خطط مدفوعة مرنة تبدأ من أسعار مناسبة للمشاريع الصغيرة وحتى الاحترافية الكبيرة. يمكنك الاطلاع على صفحة الأسعار للمزيد.'],
            ['section' => 'faq', 'field' => 'a2', 'lang' => 'en', 'value' => 'We provide a free plan to start, with flexible paid plans starting from prices suitable for small projects up to professional ones. You can check the pricing page for more details.'],
            
            // FAQ 3
            ['section' => 'faq', 'field' => 'q3', 'lang' => 'ar', 'value' => 'هل يمكنني استخدام نطاق (Domain) خاص بي؟'],
            ['section' => 'faq', 'field' => 'q3', 'lang' => 'en', 'value' => 'Can I use my own domain name?'],
            ['section' => 'faq', 'field' => 'a3', 'lang' => 'ar', 'value' => 'نعم، يمكنك ربط نطاقك الخاص بمتجرك بسهولة تامة في الخطط المدفوعة، أو استخدام نطاق فرعي مجاني نقدمه لك عند البدء.'],
            ['section' => 'faq', 'field' => 'a3', 'lang' => 'en', 'value' => 'Yes, you can connect your own domain to your store very easily in paid plans, or use a free subdomain we provide you when you start.'],

            // ===== CONTACT SECTION =====
            ['section' => 'contact', 'field' => 'title_line1', 'lang' => 'ar', 'value' => 'دعنا نساعدك في'],
            ['section' => 'contact', 'field' => 'title_line1', 'lang' => 'en', 'value' => 'Let us help you'],
            ['section' => 'contact', 'field' => 'title_highlight', 'lang' => 'ar', 'value' => 'تحويل فكرتك إلى واقع'],
            ['section' => 'contact', 'field' => 'title_highlight', 'lang' => 'en', 'value' => 'turn your idea into reality'],
            
            ['section' => 'contact', 'field' => 'description', 'lang' => 'ar', 'value' => 'فريق الخبراء لدينا جاهز للرد على استفساراتك ومساعدتك في اختيار الخطة الأنسب لمشروعك.'],
            ['section' => 'contact', 'field' => 'description', 'lang' => 'en', 'value' => 'Our team of experts is ready to answer your inquiries and help you choose the best plan for your project.'],
            
            ['section' => 'contact', 'field' => 'phone_label', 'lang' => 'ar', 'value' => 'الهاتف الموحد'],
            ['section' => 'contact', 'field' => 'phone_label', 'lang' => 'en', 'value' => 'Unified Phone'],
            ['section' => 'contact', 'field' => 'phone_value', 'lang' => 'ar', 'value' => '+966 800 123 4567'],
            ['section' => 'contact', 'field' => 'phone_value', 'lang' => 'en', 'value' => '+966 800 123 4567'],
            
            ['section' => 'contact', 'field' => 'whatsapp_label', 'lang' => 'ar', 'value' => 'واتساب مباشر'],
            ['section' => 'contact', 'field' => 'whatsapp_label', 'lang' => 'en', 'value' => 'Direct WhatsApp'],
            ['section' => 'contact', 'field' => 'whatsapp_value', 'lang' => 'ar', 'value' => '+966 50 123 4567'],
            ['section' => 'contact', 'field' => 'whatsapp_value', 'lang' => 'en', 'value' => '+966 50 123 4567'],
            
            ['section' => 'contact', 'field' => 'email_label', 'lang' => 'ar', 'value' => 'البريد الإلكتروني'],
            ['section' => 'contact', 'field' => 'email_label', 'lang' => 'en', 'value' => 'Email'],
            ['section' => 'contact', 'field' => 'email_value', 'lang' => 'ar', 'value' => 'hello@smartstore.sa'],
            ['section' => 'contact', 'field' => 'email_value', 'lang' => 'en', 'value' => 'hello@smartstore.sa'],
            
            // Form
            ['section' => 'contact', 'field' => 'form_name', 'lang' => 'ar', 'value' => 'الاسم الكامل'],
            ['section' => 'contact', 'field' => 'form_name', 'lang' => 'en', 'value' => 'Full Name'],
            ['section' => 'contact', 'field' => 'form_name_placeholder', 'lang' => 'ar', 'value' => 'أدخل اسمك'],
            ['section' => 'contact', 'field' => 'form_name_placeholder', 'lang' => 'en', 'value' => 'Enter your name'],
            
            ['section' => 'contact', 'field' => 'form_email', 'lang' => 'ar', 'value' => 'البريد الإلكتروني'],
            ['section' => 'contact', 'field' => 'form_email', 'lang' => 'en', 'value' => 'Email'],
            
            ['section' => 'contact', 'field' => 'form_inquiry_type', 'lang' => 'ar', 'value' => 'نوع الاستفسار'],
            ['section' => 'contact', 'field' => 'form_inquiry_type', 'lang' => 'en', 'value' => 'Inquiry Type'],
            ['section' => 'contact', 'field' => 'form_inquiry_support', 'lang' => 'ar', 'value' => 'دعم فني'],
            ['section' => 'contact', 'field' => 'form_inquiry_support', 'lang' => 'en', 'value' => 'Technical Support'],
            ['section' => 'contact', 'field' => 'form_inquiry_sales', 'lang' => 'ar', 'value' => 'استفسار مبيعات'],
            ['section' => 'contact', 'field' => 'form_inquiry_sales', 'lang' => 'en', 'value' => 'Sales Inquiry'],
            ['section' => 'contact', 'field' => 'form_inquiry_partners', 'lang' => 'ar', 'value' => 'شراكات'],
            ['section' => 'contact', 'field' => 'form_inquiry_partners', 'lang' => 'en', 'value' => 'Partnerships'],
            ['section' => 'contact', 'field' => 'form_inquiry_other', 'lang' => 'ar', 'value' => 'أخرى'],
            ['section' => 'contact', 'field' => 'form_inquiry_other', 'lang' => 'en', 'value' => 'Other'],
            
            ['section' => 'contact', 'field' => 'form_message', 'lang' => 'ar', 'value' => 'الرسالة'],
            ['section' => 'contact', 'field' => 'form_message', 'lang' => 'en', 'value' => 'Message'],
            ['section' => 'contact', 'field' => 'form_message_placeholder', 'lang' => 'ar', 'value' => 'كيف يمكننا مساعدتك؟'],
            ['section' => 'contact', 'field' => 'form_message_placeholder', 'lang' => 'en', 'value' => 'How can we help you?'],
            
            ['section' => 'contact', 'field' => 'form_submit', 'lang' => 'ar', 'value' => 'إرسال الرسالة'],
            ['section' => 'contact', 'field' => 'form_submit', 'lang' => 'en', 'value' => 'Send Message'],

            // ===== FOOTER =====
            ['section' => 'footer', 'field' => 'brand_desc', 'lang' => 'ar', 'value' => 'المنصة الرائدة في تمكين التجار في العالم العربي'],
            ['section' => 'footer', 'field' => 'brand_desc', 'lang' => 'en', 'value' => 'The leading platform for empowering merchants in the Arab world'],
            ['section' => 'footer', 'field' => 'copyright', 'lang' => 'ar', 'value' => '© 2026 Matjar Hub. جميع الحقوق محفوظة.'],
            ['section' => 'footer', 'field' => 'copyright', 'lang' => 'en', 'value' => '© 2026 Matjar Hub. All rights reserved.'],

            // ===== META =====
            ['section' => 'meta', 'field' => 'page_title', 'lang' => 'ar', 'value' => 'Matjar Hub - منصة التجارة الإلكترونية المتكاملة'],
            ['section' => 'meta', 'field' => 'page_title', 'lang' => 'en', 'value' => 'Matjar Hub - Integrated E-Commerce Platform'],
        ];

        foreach ($translations as $translation) {
            Landing2Translation::create($translation);
        }
    }
}
