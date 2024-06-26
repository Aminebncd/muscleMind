<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Muscle;
use App\Entity\Exercice;
use App\Entity\Ressource;
use App\Entity\MuscleGroup;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()

            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('MuscleMind')

              // by default EasyAdmin displays a black square as its default favicon;
              // use this method to display a custom favicon: the given path is passed
              // "as is" to the Twig asset() function:
              // <link rel="shortcut icon" href="{{ asset('...') }}">
              ->setFaviconPath('favicon.svg')
  
              // the domain used by default is 'messages'
              ->setTranslationDomain('my-custom-domain')
  
              // there's no need to define the "text direction" explicitly because
              // its default value is inferred dynamically from the user locale
              ->setTextDirection('ltr')
  
              // set this option if you prefer the page content to span the entire
              // browser width, instead of the default design which sets a max width
              ->renderContentMaximized()
  
              // set this option if you prefer the sidebar (which contains the main menu)
              // to be displayed as a narrow column instead of the default expanded design
              ->renderSidebarMinimized()
  
              // by default, users can select between a "light" and "dark" mode for the
              // backend interface. Call this method if you prefer to disable the "dark"
              // mode for any reason (e.g. if your interface customizations are not ready for it)
              // ->disableDarkMode()
  
              // by default, all backend URLs are generated as absolute URLs. If you
              // need to generate relative URLs instead, call this method
              ->generateRelativeUrls()
  
              // set this option if you want to enable locale switching in dashboard.
              // IMPORTANT: this feature won't work unless you add the {_locale}
              // parameter in the admin dashboard URL (e.g. '/admin/{_locale}').
              // the name of each locale will be rendered in that locale
              // (in the following example you'll see: "English", "Polski")
            //   ->setLocales(['en', 'pl'])
            //   // to customize the labels of locales, pass a key => value array
            //   // (e.g. to display flags; although it's not a recommended practice,
            //   // because many languages/locales are not associated to a single country)
            //   ->setLocales([
            //       'en' => '🇬🇧 English',
            //       'fr' => 'fr Français'
            //   ])
            //   // to further customize the locale option, pass an instance of
            //   // EasyCorp\Bundle\EasyAdminBundle\Config\Locale
            //   ->setLocales([
            //       'en', // locale without custom options
            //       Locale::new('fr', 'français', 'far fa-language') // custom label and icon
            //   ])
          ;
    }

    public function configureMenuItems(): iterable
    {

        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Ressources', 'fa fa-book', Ressource::class);
        yield MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Muscle Groups', 'fa fa-dumbbell', MuscleGroup::class);
        yield MenuItem::linkToCrud('Muscles', 'fa fa-dumbbell', Muscle::class);
        yield MenuItem::linkToCrud('Exercices', 'fa fa-dumbbell', Exercice::class);
    
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);


    }
}
