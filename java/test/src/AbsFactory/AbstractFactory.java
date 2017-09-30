package AbsFactory;

/**
 * Created by sunkeyi on 2017/9/30.
 */
public abstract class AbstractFactory {

    abstract Color getColor(String color);
    abstract Shape getShape(String shape);
}
