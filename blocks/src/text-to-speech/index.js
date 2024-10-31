const {registerPlugin} = wp.plugins;
import render from './components/Sidebar';

registerPlugin(
    'daextrevo-text-to-speech',
    {
      icon: false,
      render,
    },
);