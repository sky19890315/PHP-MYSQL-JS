package Factory;

/**
 * Created by sunkeyi on 2017/9/30.
 */
public class Rectangle implements Shape {
    @Override
    public void draw() {
        System.out.println("Inside Factory.Rectangle::draw() method.");
    }
}
