//
//  SettingsViewController.swift
//  Dog Quiz
//
//  Created by JJW on 9/22/15.
//  Copyright (c) 2015 Woof Warrior. All rights reserved.
//

import UIKit

class SettingsViewController: UIViewController {
    
    
    @IBOutlet var switches: [UISwitch]!
    @IBOutlet weak var guessesSegmentedControl: UISegmentedControl!
    var model: Model! // set by QuizViewController
    private var regionNames = ["Companion", "Hunting", "Guard", "Pariah", "Pastoral", "Sled", "Working"  ]
    private let defaultRegionIndex = 0
    
    // used to determine whether any settings changed
    private var settingsChanged = false
    
    // called when SettingsViewController is displayed
    override func viewDidLoad() {
        super.viewDidLoad()
        
        
        // select segment based on current number of guesses to display
        
        // set switches based on currently selected regions
        
    }
    
    // update guesses based on selected segment's index
    
    @IBAction func numberOfGuessesChanged(sender: UISegmentedControl) {
        
        model.setNumberOfGuesses(2 + sender.selectedSegmentIndex * 2)
        settingsChanged = true
        
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

    @IBAction func switchChanged(sender: UISwitch) {
        for i in 0 ..< switches.count {
            if sender === switches[i] {
                model.toggleRegion(regionNames[i])
                settingsChanged = true
            }
        }
        
        // if no switches on, default to North America and display error
        if model.regions.values.array.filter({$0 == true}).count == 0 {
            model.toggleRegion(regionNames[defaultRegionIndex])
            switches[defaultRegionIndex].on = true
            displayErrorDialog()
        }

    }

    func displayErrorDialog() {
        // create UIAlertController for user input
        let alertController = UIAlertController(
            title: "At Least One Region Required",
            message: String(format: "Selecting %@ as the default region.",
                regionNames[defaultRegionIndex]),
            preferredStyle: UIAlertControllerStyle.Alert)
        
        let okAction = UIAlertAction(title: "OK",
            style: UIAlertActionStyle.Cancel, handler: nil)
        alertController.addAction(okAction)
        
        presentViewController(alertController, animated: true,
            completion: nil)
    }
    
    // called when user returns to quiz
    override func viewWillDisappear(animated: Bool) {
        if settingsChanged {
            model.notifyDelegate() // called only if settings changed
        }
    }
}

