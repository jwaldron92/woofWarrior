//
//  QuizViewController.swift
//  Dog Quiz
//
//  Created by JJW on 9/22/15.
//  Copyright (c) 2015 Woof Warrior. All rights reserved.
//

import UIKit

class QuizViewController: UIViewController, ModelDelegate {


    @IBOutlet weak var flagImageView: UIImageView!
    @IBOutlet weak var questionNumberLabel: UILabel!
    @IBOutlet weak var answerLabel: UILabel!
    

    @IBOutlet var segmentedControls: [UIButton]!
    

    private var model: Model! // reference to the model object
    private let correctColor =
    UIColor(red: 0.0, green: 0.75, blue: 0.0, alpha: 1.0)
    private let incorrectColor = UIColor.redColor()
    private var quizCountries: [String]! = nil // countries in quiz
    private var enabledCountries: [String]! = nil // countries for guesses
    private var correctAnswer: String! = nil
    private var correctGuesses = 0
    private var totalGuesses = 0
    
    // obtains the app
    override func viewDidLoad() {
        super.viewDidLoad()
        
        // create Model
        model = Model(delegate: self)
        settingsChanged()
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
    
    // SettingsDelegate: reconfigures quiz when user changes settings;
    // also called when app first loads
    func settingsChanged() {
        enabledCountries = model.enabledRegionCountries
        resetQuiz()
    }
    
    // start a new quiz
    func resetQuiz() {
        quizCountries = model.newQuizCountries() // countries in new quiz
        correctGuesses = 0
        totalGuesses = 0
        
        // display appropriate # of UISegmentedControls
        for i in 0 ..< segmentedControls.count {
            segmentedControls[i].hidden =
                (i < model.numberOfGuesses / 2) ? false : true
        }
        
        nextQuestion() // display the first flag in quiz
    }
    
    // displays next question
    func nextQuestion() {
        questionNumberLabel.text = String(format: "Question %1$d of %2$d",
            (correctGuesses + 1), model.numberOfQuestions)
        answerLabel.text = ""
        correctAnswer = quizCountries.removeAtIndex(0)
        print(correctAnswer)
        flagImageView.image = UIImage(named: correctAnswer) // next flag
    
        
        // re-enable UISegmentedControls and delete prior segments

        for segmentedControl in segmentedControls {
            segmentedControl.enabled = true
            segmentedControl.hidden = false
        }

        
        // place guesses on displayed UISegmentedControls
        enabledCountries.shuffle() // use Array extension method
        var i = 0
        
        for segmentedControl in segmentedControls {
            print(i)
            print("laundry list")
            if !segmentedControl.hidden {
                segmentedControl.setTitle(countryFromFilename(enabledCountries[i]), forState: .Normal)

                    }
                    ++i
                }


    
        // pick random segment and replace with correct answer
    
        let randomRow = Int(arc4random_uniform(UInt32(2)))
        //let randomIndexInRow = Int(arc4random_uniform(UInt32(2)))
        //segmentedControls[randomRow].removeSegmentAtIndex(
            //randomIndexInRow, animated: false)
        segmentedControls[randomRow].setTitle(countryFromFilename(correctAnswer), forState: .Normal)
    }
    
    // converts image filename to displayable guess String
    func countryFromFilename(filename: String) -> String {
        var name = filename.componentsSeparatedByString("-")[1]
        let length: Int = count(name)
        name = (name as NSString).substringToIndex(length - 4)
        let components = name.componentsSeparatedByString("_")
        return join(" ", components)
    }
    
    
    @IBAction func submitGuess(sender: UIButton) {
        // get the title of the bar at that segment, which is the guess
        println(sender.currentTitle)
        var guess: String! = nil
        guess = sender.titleLabel?.text
        let correct = countryFromFilename(correctAnswer)
        println("The correct answer")
        println(correct)
        
        ++totalGuesses
        if guess != correct { // incorrect guess
            println("incorrect")
            // disable incorrect guess
            sender.enabled = false
            answerLabel.textColor = incorrectColor
            answerLabel.text = "Incorrect"
            answerLabel.alpha = 1.0
            UIView.animateWithDuration(1.0,
                animations: {self.answerLabel.alpha = 0.0})
            shakeFlag()


                } else { // correct guess
            answerLabel.textColor = correctColor
            let mySecondString = "!"
            answerLabel.text = "\(guess) \(mySecondString)"
            answerLabel.alpha = 1.0
            ++correctGuesses
            
            // disable segmentedControls
            for segmentedControl in segmentedControls {
                segmentedControl.enabled = false
            }
        
        
            if correctGuesses == model.numberOfQuestions { // quiz over
                displayQuizResults()
            } else { // use GCD to load next flag after 2 seconds
                dispatch_after(
                    dispatch_time(
                        DISPATCH_TIME_NOW, Int64(2 * NSEC_PER_SEC)),
                    dispatch_get_main_queue(), {self.nextQuestion()})
            }
        }


    }
   
    func shakeFlag() {


        
        UIView.animateWithDuration(0.1,
            animations: {self.flagImageView.frame.origin.x += 16})
        UIView.animateWithDuration(0.1, delay: 0.1, options: nil,
            animations: {self.flagImageView.frame.origin.x -= 32},
            completion: nil)
        UIView.animateWithDuration(0.1, delay: 0.2, options: nil,
            animations: {self.flagImageView.frame.origin.x += 32},
            completion: nil)
        UIView.animateWithDuration(0.1, delay: 0.3, options: nil,
            animations: {self.flagImageView.frame.origin.x -= 32},
            completion: nil)
        UIView.animateWithDuration(0.1, delay: 0.4, options: nil,
            animations: {self.flagImageView.frame.origin.x += 16},
            completion: nil)
    }
    
    // displays quiz results
    func displayQuizResults() {
        let percentString = NSNumberFormatter.localizedStringFromNumber(
            Double(correctGuesses) / Double(totalGuesses),
            numberStyle: NSNumberFormatterStyle.PercentStyle)
        
        // create UIAlertController for user input
        let alertController = UIAlertController(title: "Quiz Results",
            message: String(format: "%1$i guesses, %2$@ correct",
                totalGuesses, percentString),
            preferredStyle: UIAlertControllerStyle.Alert)
        let newQuizAction = UIAlertAction(title: "New Quiz",
            style: UIAlertActionStyle.Default,
            handler: {(action) in self.resetQuiz()})
        alertController.addAction(newQuizAction)
        presentViewController(alertController, animated: true,
            completion: nil)
    }
    
    // called before seque to SettingsViewController
    override func prepareForSegue(segue: UIStoryboardSegue,
        sender: AnyObject?) {
            
            if segue.identifier == "showSettings" {
                let controller =
                segue.destinationViewController as! SettingsViewController
                controller.model = model
            }
    }
}

// Array extension method for shuffling elements
extension Array {
    mutating func shuffle() {
        // Modern Fisher-Yates shuffle: http://bit.ly/FisherYates
        for first in stride(from: self.count - 1, through: 1, by: -1) {
            let second = Int(arc4random_uniform(UInt32(first + 1)))
            swap(&self[first], &self[second])
        }
    }
}




