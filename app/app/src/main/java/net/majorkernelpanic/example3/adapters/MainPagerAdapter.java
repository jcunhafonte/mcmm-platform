package net.majorkernelpanic.example3.adapters;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

import net.majorkernelpanic.example3.fragments.AllFragment;
import net.majorkernelpanic.example3.fragments.FavoritesFragment;
import net.majorkernelpanic.example3.fragments.SharedFragment;


/**
 * Created by Gordon Wong on 7/17/2015.
 *
 * Pager adapter for main activity.
 */
public class MainPagerAdapter extends FragmentPagerAdapter {

	public static final int NUM_ITEMS = 3;
	public static final int ALL_POS = 0;
	public static final int SHARED_POS = 1;
	public static final int FAVORITES_POS = 2;

	private Context context;

	public MainPagerAdapter(Context context, FragmentManager fm) {
		super(fm);
		this.context = context;
	}

	@Override
	public Fragment getItem(int position) {
		switch (position) {
		case ALL_POS:
			return AllFragment.newInstance();
		case SHARED_POS:
			return SharedFragment.newInstance();
		case FAVORITES_POS:
			return FavoritesFragment.newInstance();
		default:
			return null;
		}
	}

	@Override
	public CharSequence getPageTitle(int position) {
		switch (position) {
		case ALL_POS:
			return "";
		case SHARED_POS:
			return "";
		case FAVORITES_POS:
			return "";
		default:
			return "";
		}
	}

	@Override
	public int getCount() {
		return NUM_ITEMS;
	}
}
