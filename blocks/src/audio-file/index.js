const {registerPlugin} = wp.plugins;
import render from './components/Sidebar';

registerPlugin(
    'daextrevo-audio-file',
    {
      icon: false,
      render,
    },
);