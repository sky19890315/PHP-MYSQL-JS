package Builder;

/**
 * Created by sunkeyi on 2017/10/1.
 */
public abstract class Burger implements Item {

    @Override
    public Packing packing() {
        return new Wrapper();
    }

    @Override
    public abstract float price();
}
