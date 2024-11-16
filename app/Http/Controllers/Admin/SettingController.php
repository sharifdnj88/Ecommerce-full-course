<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Setting SEO Method
    public function seoIndex()
    {
        $data=DB::table('seos')->first();
        return view('admin.settings.seo.index', compact('data'));
    }

    // Setting SEO Update
    public function seoUpdate(Request $request, $id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;
        DB::table('seos')->where('id',$id)->update($data);
        $notification=array('messege' => 'SEO Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Setting Website Home Method
    public function websiteIndex()
    {
        $website=DB::table('websites')->latest()->get();
        return view('admin.settings.website.index', compact('website'));
    }

    // Website setting Edit Method
    public function websiteEdit($id)
    {
        $edit=DB::table('websites')->where('id', $id)->first();
        return view('admin.settings.website.edit', compact('edit'));
    }

    // Wetting Website Store Method
    public function websiteUpdate(Request $request)
    {
        $website=array();
        $website['currency']=$request->currency;
        $website['phone_one']=$request->phone_one;
        $website['phone_two']=$request->phone_two;
        $website['main_email']=$request->main_email;
        $website['support_email']=$request->support_email;
        $website['address']=$request->address;
        $website['facebook']=$request->facebook;
        $website['twitter']=$request->twitter;
        $website['instagram']=$request->instagram;
        $website['linkedin']=$request->linkedin;
        $website['youtube']=$request->youtube;

        if ($request->logo) {
            if ($request->old_logo ) {
                unlink('storage/setting/'. $request->old_logo);
            }
            // Website logo upload
            $slug='sharif_ecommerce_logo';
            $w_logo=$request->logo;
            $photoname=$slug.'_'.md5( time(). rand() ).'.'.$w_logo->getClientOriginalExtension();
            Image::make($w_logo)->resize(320,120)->save( storage_path('app/public/setting/'). $photoname );
            $website['logo']=$photoname; 
        }else{
            $website['logo']=$request->old_logo; 
        }

        if ($request->favicon) {
            if ($request->old_logo ) {
                unlink('storage/setting/'. $request->old_favicon);
            }
            // Website logo upload
            $slug='sharif_ecommerce_favicon';
            $w_icon=$request->favicon;
            $photoname=$slug.'_'.md5( time(). rand() ).'.'.$w_icon->getClientOriginalExtension();
            Image::make($w_icon)->resize(32,32)->save( storage_path('app/public/setting/'). $photoname );
            $website['favicon']=$photoname; 
        }else{
            $website['favicon']=$request->old_favicon; 
        }         

         DB::table('websites')->where('id', $request->id)->update($website);

         $notification=array('messege' => 'Website Setting Update!', 'alert-type' => 'success');
         return redirect()->back()->with($notification);
        
    }

    // Website Setting Update Method
    public function websiteStore(Request $request)
    {
        $website=array();
        $website['currency']=$request->currency;
        $website['phone_one']=$request->phone_one;
        $website['phone_two']=$request->phone_two;
        $website['main_email']=$request->main_email;
        $website['support_email']=$request->support_email;
        $website['address']=$request->address;
        $website['facebook']=$request->facebook;
        $website['twitter']=$request->twitter;
        $website['instagram']=$request->instagram;
        $website['linkedin']=$request->linkedin;
        $website['youtube']=$request->youtube;

         // Website logo upload
         $slug='sharif_ecommerce_logo';
         $w_logo=$request->logo;
         $photoname=$slug.'_'.md5( time(). rand() ).'.'.$w_logo->getClientOriginalExtension();
         Image::make($w_logo)->resize(320,120)->save( storage_path('app/public/setting/'). $photoname );
         $website['logo']=$photoname; 

         // Website logo upload
         $slug='sharif_ecommerce_favicon';
         $w_icon=$request->favicon;
         $photoname=$slug.'_'.md5( time(). rand() ).'.'.$w_icon->getClientOriginalExtension();
         Image::make($w_logo)->resize(32,32)->save( storage_path('app/public/setting/'). $photoname );
         $website['favicon']=$photoname; 

         DB::table('websites')->insert($website);

         $notification=array('messege' => 'Website Setting Inserted!', 'alert-type' => 'success');
         return redirect()->back()->with($notification);
    }

    // Setting Website Delete Method
    public function websiteDestroy($id)
    {
        $website=DB::table('websites')->where('id', $id)->first();
        DB::table('websites')->where('id', $id)->delete();       

        // Website Logo delete
        $logo=$website->logo;
        if ($logo) {
            unlink('storage/setting/'. $logo);
        }

        // Website favicon delete
        $icon=$website->favicon;
        if ($icon) {
            unlink('storage/setting/'. $icon);
        }

        $notification=array('messege' => 'Website Setting Delete!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }
    

    // Setting SMTP Home Method
    public function smtpIndex()
    {
        $smtp=DB::table('smtps')->first();
        return view('admin.settings.smtp.index', compact('smtp'));
    }

    // Setting SMTP Update Method
    public function smtpUpdate(Request $request, $id)
    {
        $smtp=array();
        $smtp['mailer']     =$request->mailer;
        $smtp['host']       =$request->host;
        $smtp['port']       =$request->port;
        $smtp['user_name']  =$request->user_name;
        $smtp['password']   =$request->password;
        $smtp['address']    =$request->address;

        DB::table('smtps')->where('id', $id)->update($smtp);
        $notification=array('messege' => 'SMTP Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    // Setting Page Home Method
    public function pageIndex()
    {
        $page=DB::table('pages')->latest()->get();
        return view('admin.settings.pages.index', compact('page'));
    }

    // Setting Page Store Method
    public function pageStore(Request $request)
    {
        $page=array();
        $page['page_name']=$request->page_name;
        $page['page_slug']=Str::slug($request->page_name, '-');
        $page['page_title']=$request->page_title;
        $page['page_position']=$request->page_position;
        $page['page_description']=$request->page_description;

        DB::table('pages')->insert($page);
        $notification=array('messege' => 'Page Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Setting Page Delete Method
    public function pageDestroy($id)
    {
        DB::table('pages')->where('id', $id)->delete();

        $notification=array('messege' => 'Page Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Setting Page Edit Method
    public function PageEdit($id)
    {
        $edit_page=DB::table('pages')->where('id', $id)->first();
        return view('admin.settings.pages.edit', compact('edit_page'));
    }

    // Setting Page Update Method
    public function pageUpdate(Request $request)
    {
        $pageUpdate=array();
        $pageUpdate['page_name']=$request->page_name;
        $pageUpdate['page_slug']=Str::slug($request->page_name, '-');
        $pageUpdate['page_title']=$request->page_title;
        $pageUpdate['page_position']=$request->page_position;
        $pageUpdate['page_description']=$request->page_description;

        DB::table('pages')->where('id', $request->id)->update($pageUpdate);
        $notification=array('messege' => 'Page Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }




}
