package Factory;

import Factory.Shape;

/**
 * Created by sunkeyi on 2017/9/30.
 */
public class Square implements Shape {

    @Override
    public void draw() {
        System.out.println("Inside Factory.Square::draw() method.");
    }
}
