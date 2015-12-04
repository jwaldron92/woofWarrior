//
//  ViewController.swift
//  Woof Warrior
//
//  Created by JJW on 9/18/15.
//  Copyright (c) 2015 Woof Warrior. All rights reserved.
//

import UIKit

class ViewController: UIViewController {


    @IBAction func site(sender: AnyObject) {
        if let url = NSURL(string: "http://www.woofwarrior.com") {
            UIApplication.sharedApplication().openURL(url)
        }
    }

    @IBAction func email(sender: AnyObject) {
        if let url = NSURL(string: "http://www.newsletter.woofwarrior.com") {
            UIApplication.sharedApplication().openURL(url)
        }
    }
    
    override func viewDidAppear(animated: Bool) {
        // 1
        var nav = self.navigationController?.navigationBar
        // 2
        nav?.barStyle = UIBarStyle.Black
        nav?.tintColor = UIColor(red: 215/255, green: 57/255, blue: 183/255, alpha: 1)
        nav?.layer.shadowOpacity = 0.7
        // 3
        nav?.layer.shadowColor = UIColor.yellowColor().CGColor
        nav?.layer.shadowOpacity = 0.7
        nav?.layer.shadowOffset = CGSize(width: 0.0, height: 0.0)
        nav?.layer.shadowRadius = 15.0
        nav?.layer.shadowColor = UIColor.yellowColor().CGColor
        view.backgroundColor = UIColor(red: 104/255, green: 215/255, blue: 57/255, alpha: 1)
        

    }
    var navBar:UINavigationBar=UINavigationBar()
    
    @IBAction func quiz(sender: AnyObject) {
            }
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }


    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

