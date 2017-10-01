package Singleton;

/**
 * Created by sunkeyi on 2017/10/1.
 */
public class SingleObject {

    private static SingleObject instance = new SingleObject();

    private SingleObject() {}

    public static SingleObject getInstance() {
        return instance;
    }

    public void showMessage() {
        System.out.println("Hello world!");
    }
}
