//
//  PushButtonView.swift
//  Dog Quiz
//
//  Created by JJW on 9/28/15.
//  Copyright (c) 2015 Woof Warrior. All rights reserved.
//

import UIKit
@IBDesignable

class PushButtonView: UIButton {

    /*
    // Only override drawRect: if you perform custom drawing.
    // An empty implementation adversely affects performance during animation.
    override func drawRect(rect: CGRect) {
        // Drawing code
    }
    */
    
    override func drawRect(rect: CGRect) {
        var path = UIBezierPath(ovalInRect: rect)
        UIColor.yellowColor().setFill()
        path.fill()
        
}
}
