package Singleton;

/**
 * Created by sunkeyi on 2017/10/1.
 */
public class SingletonPatternDemo {

    public static void main(String [] args) {
        SingleObject object = SingleObject.getInstance();

        object.showMessage();
    }
}
